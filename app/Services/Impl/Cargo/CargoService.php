<?php  
namespace App\Services\Impl\Cargo;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Services\Interfaces\Cargo\CargoServiceInterface;
use App\Repositories\Cargo\CargoRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CargoService extends BaseService implements CargoServiceInterface{

    protected $repository;

    public function __construct(
        CargoRepository $repository
    )
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    protected function prepareModelData(Request $request): self
    {
        return $this->initializeBasicData($request)->convertToDecimal();
    }

    private function initializeBasicData(Request $request): self {
        $fillable = $this->repository->getFillable();
        $this->modelData = $request->only($fillable);
        $this->modelData['entry_date'] = Carbon::createFromFormat('d/m/Y', $request->entry_date)->format('Y-m-d');
        if(isset($request->close)){
            $this->modelData['close'] = $request->close == 'on' ? 1 : 0;
            $this->modelData['person_close_id'] = Auth::user()->id;
        }
        return $this;
    }

   // Trong CargoRepository
    public function getDecimalFields() {
        return [
            'temp_import', 'reexport', 'overdue_not_reexported',
            'export_turnover', 'import_turnover', 'taxable_export_turnover',
            'taxable_import_turnover', 'outgoing_transit', 'incoming_transit',
            'outgoing_transit_turnover', 'incoming_transit_turnover'
        ];
    }

    // Trong Service
    private function convertToDecimal(): self{
        $decimalFields = $this->getDecimalFields();
        
        foreach ($decimalFields as $field) {
            if (isset($this->modelData[$field]) && !empty($this->modelData[$field])) {
                $this->modelData[$field] = floatval(str_replace(',', '', $this->modelData[$field]));
            }
        }
        
        return $this;
    }

}