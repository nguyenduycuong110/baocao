<?php 
namespace App\Http\Controllers\Web\Violation;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Violation\Violation\StoreRequest;
use App\Http\Requests\Violation\Violation\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Violation\ViolationServiceInterface as ViolationService;


class ViolationController extends BaseController{

    protected $namespace = 'violation';
    protected $route = 'violations';
    protected $fields = [
        'smuggling_cases','smuggling_value', 'drug_cases', 'drug_pills',
        'ip_cases', 'ip_value' , 'admin_cases' , 'admin_value' , 'other_cases' ,
        'other_value'
    ];

    protected $service;

    public function __construct(
        ViolationService $service
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