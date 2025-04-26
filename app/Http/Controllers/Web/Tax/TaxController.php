<?php 
namespace App\Http\Controllers\Web\Tax;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tax\Tax\StoreRequest;
use App\Http\Requests\Tax\Tax\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Tax\TaxServiceInterface as TaxService;


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
    public function store(StoreRequest $request): RedirectResponse{
        return $this->baseSave($request);
    }
    public function update(UpdateRequest $request, int $id){
        return $this->baseSave($request, $id);
    }


}   