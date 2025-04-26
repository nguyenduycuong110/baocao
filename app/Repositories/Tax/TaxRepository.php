<?php 
namespace App\Repositories\Tax;
use App\Repositories\BaseRepository;
use App\Models\Tax;

class TaxRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Tax $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}