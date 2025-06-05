<?php  
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD

=======
use Illuminate\Support\Facades\DB;
>>>>>>> 00b77f50c1b39279f711d627a6ce349fb29551e0

class BaseRepository {
    protected $model;

    public function __construct(
        Model $model
    ){
        $this->model = $model;
    }

    public function findById(int $id = 0, $relation = []): Model | null{
        return $this->model->with($relation)->find($id);
    }

    public function findByCode(int $code = 0, $relation = []): Model | null{
        return $this->model->with($relation)->where('code', $code)->first();
    }

    public function create(array $payload = []): Model{
        return $this->model->create($payload)->fresh();
    }

    public function update(int $id = 0, array $payload = []): Model {
        $model = $this->findById($id);
        $model->fill($payload);
        $model->save();
        return $model;
    }

    public function delete(Model $model): bool{
        return $model->delete();
    }

    public function forceDelete(Model $model): bool{
        return $model->forceDelete();
    }

    public function getFillable(): array {
        return $this->model->getFillable();
    }

    public function bulkDelete(array $whereIn = [], string $whereInField = 'id'): bool {
        return $this->model->where($whereInField, $whereIn)->delete();
    }

    public function paginate(array $specifications = []){
        return $this->model
        ->keyword($specifications['keyword'] ?? [])
        ->simpleFilter($specifications['filters']['simple'] ?? [])
        ->complexFilter($specifications['filters']['complex'] ?? [])
        ->dateFilter($specifications['filters']['date'] ?? [])
        ->relationFilter($specifications['filters']['relation'] ?? [])
        ->relation($specifications['with'] ?? [])
        ->orderBy($specifications['sort'][0], $specifications['sort'][1])
        ->when($specifications['type'],
            fn($q) => $q->get(),
            fn($q) => $q->paginate($specifications['perpage'])
        );
    }

    public function getRelations() {
       return $this->model->getRelations();
    }

    public function all(){
        return $this->model->select('*')->get();
    }
    
    public function getLatestEntryDate()
    {
<<<<<<< HEAD
        return $this->model->max('entry_date');
    }

    public function accumulatedMonth($fields = [], $cutoffDate, $userIds)
    {

        $temp = [
            0 => Auth::user()->id
        ];

        $userIds = ($userIds != null) ? $userIds : $temp;
         
        $startOfMonth = $cutoffDate->copy()->startOfMonth();
        
        return $this->model->selectRaw(implode(', ', array_map(function($field) {
            return "SUM(`{$field}`) as total_$field";
        }, $fields)))
            ->whereBetween('entry_date', [$startOfMonth, $cutoffDate->endOfDay()])
            ->whereIn('user_id', $userIds)
=======
        $auth = Auth::user();
        $userTeamIds = DB::table('users')->where('team_id', $auth->team_id)->get()->pluck('id')->toArray();

        return $this->model->selectRaw('MONTH(entry_date) as month, ' . implode(', ', array_map(function($field) {
            return "SUM(`{$field}`) as total_$field";
        }, $fields)))
            ->whereRaw('MONTH(entry_date) = ?', [$month])
            ->where('entry_date', '<=', now()->endOfDay()) 
            ->whereIn('user_id', $userTeamIds)
            ->groupBy('month')
>>>>>>> 00b77f50c1b39279f711d627a6ce349fb29551e0
            ->first();
    }

    public function accumulatedYear($fields = [], $cutoffDate, $userIds)
    {
<<<<<<< HEAD

        $temp = [
            0 => Auth::user()->id
        ];

        $userIds = ($userIds != null) ? $userIds : $temp;

        $startOfYear = $cutoffDate->copy()->startOfYear();
        
        return $this->model->selectRaw(implode(', ', array_map(function($field) {
            return "SUM(`{$field}`) as total_$field";
        }, $fields)))
            ->whereBetween('entry_date', [$startOfYear, $cutoffDate->endOfDay()])
            ->whereIn('user_id', $userIds)
=======
        $auth = Auth::user();
        $userTeamIds = DB::table('users')->where('team_id', $auth->team_id)->get()->pluck('id')->toArray();

        return $this->model->selectRaw('YEAR(entry_date) as year, ' . implode(', ', array_map(function($field) {
            return "SUM(`{$field}`) as total_$field";
        }, $fields)))
            ->whereRaw('YEAR(entry_date) = ?', [$year])
            ->where('entry_date', '<=', now()->endOfDay()) 
            ->whereIn('user_id', $userTeamIds)
            ->groupBy('year')
>>>>>>> 00b77f50c1b39279f711d627a6ce349fb29551e0
            ->first();
    }

}