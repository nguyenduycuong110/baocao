<?php 
namespace App\Http\Controllers\Web\Merchandise;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Merchandise\Merchandise\StoreRequest;
use App\Http\Requests\Merchandise\Merchandise\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Merchandise\MerchandiseServiceInterface as MerchandiseService;


class MerchandiseController extends BaseController{

    protected $namespace = 'merchandise';
    protected $route = 'merchandises';
    protected $fields = ['cassava'];

    protected $service;


    public function __construct(
        MerchandiseService $service
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