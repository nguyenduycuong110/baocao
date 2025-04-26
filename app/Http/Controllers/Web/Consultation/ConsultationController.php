<?php 
namespace App\Http\Controllers\Web\Consultation;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Consultation\Consultation\StoreRequest;
use App\Http\Requests\Consultation\Consultation\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Consultation\ConsultationServiceInterface as ConsultationService;


class ConsultationController extends BaseController{

    protected $namespace = 'consultation';
    protected $route = 'consultations';
    protected $fields = ['declaration', 'accept_value', 'reject_value'];

    protected $service;


    public function __construct(
        ConsultationService $service
    )
    {
        $this->service = $service;
        parent::__construct($service);
    }
    public function store(StoreRequest $request): RedirectResponse{
        return $this->baseSave($request);
    }
    public function update(UpdateRequest $request, int $id){
        return $this->baseSave($request, $id);
    }


}   