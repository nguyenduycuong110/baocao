<?php 
namespace App\Http\Controllers\Web\Passenger;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Passenger\Passenger\StoreRequest;
use App\Http\Requests\Passenger\Passenger\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Passenger\PassengerServiceInterface as PassengerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class PassengerController extends BaseController{

    protected $namespace = 'passenger';
    protected $route = 'passengers';
    protected $fields = ['departure','entry'];

    protected $service;

    public function __construct(
        PassengerService $service
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