<?php 
namespace App\Http\Controllers\Web\Check;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Check\Check\StoreRequest;
use App\Http\Requests\Check\Check\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Check\CheckServiceInterface as CheckService;

class CheckController extends BaseController{

    protected $namespace = 'check';
    protected $route = 'checks';
    protected $fields = ['department_level','branch_level'];

    protected $service;


    public function __construct(
        CheckService $service
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