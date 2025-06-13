<?php  
namespace App\Services\Impl\Merchandise;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Services\Interfaces\Merchandise\MerchandiseServiceInterface;
use App\Repositories\Merchandise\MerchandiseRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MerchandiseService extends BaseService implements MerchandiseServiceInterface{

    protected $repository;

    public function __construct(
        MerchandiseRepository $repository
    )
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    protected function prepareModelData(Request $request): self
    {
        return $this->initializeBasicData($request);
    }

    private function initializeBasicData(Request $request): self {
        $fillable = $this->repository->getFillable();
        $this->modelData = $request->only($fillable);
        $this->modelData['entry_date'] = Carbon::createFromFormat('d/m/Y', $request->entry_date)->format('Y-m-d');
        if(isset($request->close)){
            $this->modelData['close'] = $request->close == 'on' ? 1 : 0;
            $this->modelData['person_close_id'] = Auth::user()->id;
        }
        return $this;
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

    public function saveModel(?int $id = null): self{
        $method = $id != null ? 'update' : 'create';
        if($id){
            $this->modelData['id'] = $id;
            $this->model = $this->repository->update($id, $this->modelData);
        }else{
            $this->model = $this->repository->create($this->modelData);
        }
        $this->result = $this->model;
        $this->result['method'] = $method;
        return $this;
    } 
    
    public function handleRelations($request): self{
        $payload = [];
        $merchandise_id = $this->result->id;
        $merchandise_products = $request->merchandise_products;
        if(count($merchandise_products)){
            foreach($merchandise_products['name'] as $k => $v){
                $payload[] = [
                    'merchandise_id' => $merchandise_id,
                    'name' => $v,
                    'value' => convert_price_usd($merchandise_products['value'][$k])
                ];
            }
        }
        if($this->result->method == 'create'){
            foreach ($payload as $item) {
                $this->result->merchandise_products()->create($item);
            }
        }else{
            $this->result->merchandise_products()->delete();
            foreach ($payload as $item) {
                $this->result->merchandise_products()->create($item);
            }
        }
        return $this;
    }
    

    private function getResult(): mixed{
        return $this->result;
    }
    
    

}