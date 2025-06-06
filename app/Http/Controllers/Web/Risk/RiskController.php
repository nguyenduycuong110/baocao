<?php 
namespace App\Http\Controllers\Web\Risk;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Risk\Risk\StoreRequest;
use App\Http\Requests\Risk\Risk\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Risk\RiskServiceInterface as RiskService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RiskController extends BaseController{

    protected $namespace = 'risk';
    protected $route = 'risks';
    protected $fields = [
        'flow_decl','stop_via_supervision','violated_decl','collect_bus_info',
        'act_disb_setup', 'item_profile_set', 'bus_profile_set','prop_disb_setup',
    ];

    protected $service;

    public function __construct(
        RiskService $service
    )
    {
        $this->service = $service;
        parent::__construct($service);
    }

    public function index(Request $request): View | RedirectResponse{
        try {
            $request = $this->service->mergeRequest($request);
            $records = $this->service->paginate($request);
            $config = $this->config();
            $auth = Auth::user();
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