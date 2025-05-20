<?php 
namespace App\Http\Controllers\Web\Other;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Other\Other\StoreRequest;
use App\Http\Requests\Other\Other\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Other\OtherServiceInterface as OtherService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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

    public function index(Request $request): View | RedirectResponse{
        try {
            $request = $this->service->mergeRequest($request);
            $records = $this->service->paginate($request);
            $auth = Auth::user();
            $config = $this->config();
            $config['users'] = $this->service->getUser();
            $config['model'] = Str::studly(Str::singular($this->route));
            $data = $this->getData();
            extract($data);
            return view("backend.{$this->namespace}.index", compact(
                'records',
                'auth',
                'config',
                ...array_keys($data)
            ));
        } catch (\Throwable $th) {
            return $this->handleWebLogException($th);
        }
    }
    
    public function store(StoreRequest $request): RedirectResponse{
        return $this->baseSave($request);
    }


    public function update(UpdateRequest $request, int $id){
        return $this->baseSave($request, $id);
    }


}   