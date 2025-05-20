<?php 
namespace App\Http\Controllers\Web\Cargo;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Cargo\Cargo\StoreRequest;
use App\Http\Requests\Cargo\Cargo\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Cargo\CargoServiceInterface as CargoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CargoController extends BaseController{

    protected $namespace = 'cargo';
    protected $route = 'cargos';
    protected $fields = [
        'green_channel', 'yellow_channel', 'red_channel', 'void_declaration', 'green_channel_import',
        'yellow_channel_import', 'red_channel_import', 'void_declaration_import', 'temp_import',
        'reexport', 'overdue_not_reexported', 'export_turnover', 'import_turnover', 'taxable_export_turnover',
        'taxable_import_turnover', 'outgoing_transit', 'incoming_transit', 'outgoing_transit_turnover', 'incoming_transit_turnover'
    ];

    protected $service;


    public function __construct(
        CargoService $service
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