<?php 
namespace App\Repositories\Digital;
use App\Repositories\BaseRepository;
use App\Models\Digital;

class DigitalRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Digital $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}