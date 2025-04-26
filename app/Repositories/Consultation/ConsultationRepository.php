<?php 
namespace App\Repositories\Consultation;
use App\Repositories\BaseRepository;
use App\Models\Consultation;

class ConsultationRepository extends  BaseRepository{

    protected $model;

    public function __construct(
        Consultation $model
    )
    {
        $this->model = $model;    
        parent::__construct($model);
    }

    

}