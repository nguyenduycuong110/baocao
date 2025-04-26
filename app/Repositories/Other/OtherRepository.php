<?php 
namespace App\Repositories\Other;
use App\Repositories\BaseRepository;
use App\Models\Other;

class OtherRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Other $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}