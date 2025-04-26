<?php 
namespace App\Repositories\Merchandise;
use App\Repositories\BaseRepository;
use App\Models\Merchandise;

class MerchandiseRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Merchandise $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}