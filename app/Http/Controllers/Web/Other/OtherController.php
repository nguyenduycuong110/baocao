<?php 
namespace App\Http\Controllers\Web\Other;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Other\Other\StoreRequest;
use App\Http\Requests\Other\Other\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Other\OtherServiceInterface as OtherService;


class OtherController extends BaseController{

    protected $namespace = 'other';
    protected $route = 'others';
    protected $fields = ['admin_guidelines','business_info', 'issue_solving', 'regulation_proposal'];

    protected $service;


    public function __construct(
        OtherService $service
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