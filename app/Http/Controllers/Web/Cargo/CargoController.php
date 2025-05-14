<?php 
namespace App\Http\Controllers\Web\Cargo;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Cargo\Cargo\StoreRequest;
use App\Http\Requests\Cargo\Cargo\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Cargo\CargoServiceInterface as CargoService;


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
    public function store(StoreRequest $request): RedirectResponse{
        return $this->baseSave($request);
    }
    public function update(UpdateRequest $request, int $id){
        return $this->baseSave($request, $id);
    }


}   