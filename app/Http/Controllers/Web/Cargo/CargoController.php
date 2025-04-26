<?php 
namespace App\Http\Controllers\Web\Cargo;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Cargo\Cargo\StoreRequest;
use App\Http\Requests\Cargo\Cargo\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Cargo\CargoServiceInterface as CargoService;


class CargoController extends BaseController{

    protected $namespace = 'cargo';
    protected $route = 'cargos';

    protected $service;


    public function __construct(
        CargoService $service
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