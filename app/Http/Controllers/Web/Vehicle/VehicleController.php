<?php 
namespace App\Http\Controllers\Web\Vehicle;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Vehicle\Vehicle\StoreRequest;
use App\Http\Requests\Vehicle\Vehicle\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Vehicle\VehicleServiceInterface as VehicleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VehicleController extends BaseController{

    protected $namespace = 'vehicle';
    protected $route = 'vehicles';
    protected $fields = ['car_exit','boats_exit','car_entry','boats_entry'];

    protected $service;

    public function __construct(
        VehicleService $service
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