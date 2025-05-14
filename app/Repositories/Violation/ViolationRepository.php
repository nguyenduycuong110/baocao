<?php 
namespace App\Repositories\Violation;
use App\Repositories\BaseRepository;
use App\Models\Violation;

class ViolationRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Violation $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}