<?php 
namespace App\Http\Controllers\Web\Tax;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tax\Tax\StoreRequest;
use App\Http\Requests\Tax\Tax\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Tax\TaxServiceInterface as TaxService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaxController extends BaseController{

    protected $namespace = 'tax';
    protected $route = 'taxes';
    protected $fields = [
        'vat_tax','export_import_tax','income_tax','personal_income_tax',
        'other_revenue', 'refunded_tax_declaration', 'refunded_tax_amount',
        'current_debt', 'overdue_debt' , 'tax_collection_declaration' , 
        'tax_amount' , 'business'
    ];

    protected $service;


    public function __construct(
        TaxService $service
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