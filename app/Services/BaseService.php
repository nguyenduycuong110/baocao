<?php 
namespace App\Services;
use App\Services\Interfaces\BaseServiceInterface;
use App\Traits\HasTransaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Lang;
use App\Traits\HasRelation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

abstract class BaseService implements BaseServiceInterface{

    use HasTransaction, HasRelation;

    protected $nestedset;

    private $repository;
    private $model;
    private $result;
    protected $modelData;

    protected $fieldSearchs = ['name','user_id'];
    protected $simpleFilter = ['publish', 'user_id']; // hook
    protected $complexFilter = ['id']; // hook
    protected $dateFilter = ['created_at', 'updated_at'];
    protected $sort = ['id', 'asc'];

    protected $with = []; 


    protected const PERPAGE = 15;

    protected const OFFICER_ID = 5;


    public function __construct(
        $repository
    )
    {
        $this->repository = $repository;
    }

    protected abstract function prepareModelData(Request $request);
    

    private function buildFilter(Request $request, array $filters = []): array {
        $conditions = [];
        if(count($filters)){
            foreach($filters as $key => $filter){
                if($request->has($filter)){
                    $conditions[$filter] = $request->{$filter};
                }
            }
        }
        return $conditions;
    }

    public function specifications($request): array{
        return [
            'type' => $request->type === 'all', 
            'perpage' => $request->perpage ?? self::PERPAGE,
            'sort' => $request->sort ? explode(',', $request->sort) : $this->sort,
            'keyword' => [
                'q' => $request->keyword,
                'fields' => $this->fieldSearchs
            ],
            'filters' => [
                'simple' => $this->buildFilter($request, $this->simpleFilter),
                'complex' => $this->buildFilter($request, $this->complexFilter),
                'date' => $this->buildFilter($request, $this->dateFilter),
                'relation' => $request->relationFilter,
            ],
            'with' => $this->with,
        ];  
    }

    public function paginate(Request $request): LengthAwarePaginator | Collection{
        $specifications = $this->specifications($request);
        return $this->repository->paginate($specifications);
    }

    public function save($request, ?int $id = null){
        try {
            return $this->beginTransaction()
                ->prepareModelData($request)
                ->beforeSave($id)
                ->saveModel($id)
                ->handleRelations($request)
                ->afterSave()
                ->commit()
                ->getResult();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function saveModel(?int $id = null): self{
        if($id){
            $this->model = $this->repository->update($id, $this->modelData);
        }else{
            $this->model = $this->repository->create($this->modelData);
        }
        $this->result = $this->model;
        return $this;
    } 

    private function getResult(): mixed{
        return $this->result;
    }

    public function findById(int $id = 0): Model | null{
        try {
            if(!$model = $this->repository->findById($id)){
                throw new ModelNotFoundException(Lang::get('message.not_found'));
            }
            return $model;
        } catch (\Throwable $th) {
           throw $th;
        }
    }

    public function findByCode(int $code = 0, $relation): Model | null{
        $model = $this->repository->findByCode($code, $relation);
        return $model;
    }

    public function destroy(int $id = 0): bool{
        try {
            if(!$model = $this->repository->findById($id)){
                throw new ModelNotFoundException(Lang::get('message.not_found'));
            }   
            return $this->repository->delete($model);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateStatus($post = []){
        try {
            $id = $post['modelId'];
            if(!$this->repository->findById($id)){
                throw new ModelNotFoundException(Lang::get('message.not_found'));
            }   
            $payload[$post['field']] = (($post['value'] == config('apps.general.off')) ? config('apps.general.on') : config('apps.general.off'));
            return $this->repository->update($post['modelId'], $payload);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function all(){
        try {
            if(!$this->repository->all()){
                throw new ModelNotFoundException(Lang::get('message.not_found'));
            }   
            return $this->repository->all();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function accumulated($fields = [], $id = null)
    {
        try {

            $accumulated = [];

            $accumulatedMonth = 0;

            $accumulatedYear = 0;

            $userIds = null;

            $auth = Auth::user();

            $isLeader = ($auth->teams->manager_id  == $auth->id) ? true : false;

            if($isLeader == true){
                $teamId = $auth->teams->id;
                $userIds = User::where('team_id', $teamId)->get()->pluck('id')->toArray();
            }

            if (!count($this->repository->all())) {
                return $accumulated;
            }
            
            if (!is_null($id)) {
                $record = $this->repository->findById($id);
                if (!$record) {
                    return $accumulated; 
                }
                $cutoffDate = Carbon::parse($record->entry_date);
            } else {
                $cutoffDate = now();
            }

            $accumulatedMonth = $this->repository->accumulatedMonth($fields, $cutoffDate, $userIds);

            $accumulatedYear = $this->repository->accumulatedYear($fields, $cutoffDate, $userIds);
            
            $accumulated = [
                'accumulatedMonth' => $accumulatedMonth,
                'accumulatedYear' => $accumulatedYear,
            ];

            return $accumulated;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function mergeRequest($request){
        $auth = Auth::user();
        $level = $auth->user_catalogues->level;
        if($level == self::OFFICER_ID){
            $request->merge([
                'user_id' => $auth->id
            ]);
        }else{
            $request->merge([
                'relationFilter' => 
                    [
                        'users.user_catalogues' =>  [
                            'level' => ['gte' => $auth->user_catalogues->level]
                        ],
                        'users.teams' => [
                            'id' => ['eq' => $auth->teams->id]
                        ]
                    ],
            ]);
        }
        return $request;
    }

    public function getUser(){
        $auth = Auth::user();
        $level = $auth->user_catalogues->level;
        $team_id = $auth->teams->id;
        $users = User::where('team_id', $team_id)
        ->whereHas('user_catalogues', function ($query) use ($level) {
            $query->where('level', '>' , $level);
        })
        ->with(['user_catalogues' => function ($query) use ($level) {
            $query->where('level', '>' , $level);
        }])
        ->get();
        return $users;
    }

}