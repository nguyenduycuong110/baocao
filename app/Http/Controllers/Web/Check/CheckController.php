<?php 
namespace App\Http\Controllers\Web\Check;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Check\Check\StoreRequest;
use App\Http\Requests\Check\Check\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Check\CheckServiceInterface as CheckService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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