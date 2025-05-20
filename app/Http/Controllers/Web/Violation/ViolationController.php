<?php 
namespace App\Http\Controllers\Web\Violation;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Violation\Violation\StoreRequest;
use App\Http\Requests\Violation\Violation\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Violation\ViolationServiceInterface as ViolationService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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