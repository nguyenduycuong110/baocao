<?php  
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;


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
    
    public function accumulatedMonth($fields = [], $month){
        return $this->model->selectRaw('MONTH(entry_date) as month, ' . implode(', ', array_map(function($field) {
            return "SUM(`{$field}`) as total_$field";
        }, $fields)))
        ->whereRaw('MONTH(entry_date) = ?', [$month])
        ->groupBy('month')
        ->first();
    }

    public function accumulatedYear($fields = [], $year){
        return $this->model->selectRaw('YEAR(entry_date) as year, ' . implode(', ', array_map(function($field) {
            return "SUM(`{$field}`) as total_$field";
        }, $fields)))
        ->whereRaw('YEAR(entry_date) = ?', [$year])
        ->groupBy('year')
        ->first();
    }

    

}