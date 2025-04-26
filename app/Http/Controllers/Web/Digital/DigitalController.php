<?php 
namespace App\Http\Controllers\Web\Digital;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Digital\Digital\StoreRequest;
use App\Http\Requests\Digital\Digital\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Digital\DigitalServiceInterface as DigitalService;


class DigitalController extends BaseController{

    protected $namespace = 'digital';
    protected $route = 'digitals';
    protected $fields = ['department_level','branch_level'];

    protected $service;


    public function __construct(
        DigitalService $service
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