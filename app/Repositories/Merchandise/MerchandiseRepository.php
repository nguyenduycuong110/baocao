<?php 
namespace App\Repositories\Merchandise;
use App\Repositories\BaseRepository;
use App\Models\Merchandise;
use Illuminate\Database\Eloquent\Model;

class MerchandiseRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Merchandise $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    public function create(array $payload = []): Model{
        return $this->model->create($payload)->fresh();
    }

    

}