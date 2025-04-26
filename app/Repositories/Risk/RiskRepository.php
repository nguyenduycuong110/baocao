<?php 
namespace App\Repositories\Risk;
use App\Repositories\BaseRepository;
use App\Models\Risk;

class RiskRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Risk $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}