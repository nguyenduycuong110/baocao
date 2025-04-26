<?php 
namespace App\Repositories\Vehicle;
use App\Repositories\BaseRepository;
use App\Models\Vehicle;

class VehicleRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Vehicle $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}