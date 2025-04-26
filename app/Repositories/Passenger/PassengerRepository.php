<?php 
namespace App\Repositories\Passenger;
use App\Repositories\BaseRepository;
use App\Models\Passenger;

class PassengerRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Passenger $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}