<?php 
namespace App\Repositories\Cargo;
use App\Repositories\BaseRepository;
use App\Models\Cargo;

class CargoRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Cargo $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}