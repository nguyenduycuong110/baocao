<?php 
namespace App\Repositories\Check;
use App\Repositories\BaseRepository;
use App\Models\Check;

class CheckRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Check $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}