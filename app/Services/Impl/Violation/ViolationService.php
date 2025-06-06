<?php  
namespace App\Services\Impl\Violation;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Services\Interfaces\Violation\ViolationServiceInterface;
use App\Repositories\Violation\ViolationRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ViolationService extends BaseService implements ViolationServiceInterface{

    protected $repository;

    public function __construct(
        ViolationRepository $repository
    )
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    protected function prepareModelData(Request $request): self
    {
        return $this->initializeBasicData($request);
    }

    private function initializeBasicData(Request $request): self {
        $fillable = $this->repository->getFillable();
        $this->modelData = $request->only($fillable);
        $this->modelData['smuggling_cases'] = convert_price($this->modelData['smuggling_cases']);
        $this->modelData['smuggling_value'] = convert_price($this->modelData['smuggling_value']);
        $this->modelData['drug_cases'] = convert_price($this->modelData['drug_cases']);
        $this->modelData['drug_pills'] = convert_price($this->modelData['drug_pills']);
        $this->modelData['ip_cases'] = convert_price($this->modelData['ip_cases']);
        $this->modelData['ip_value'] = convert_price($this->modelData['ip_value']);
        $this->modelData['admin_cases'] = convert_price($this->modelData['admin_cases']);
        $this->modelData['admin_value'] = convert_price($this->modelData['admin_value']);
        $this->modelData['other_cases'] = convert_price($this->modelData['other_cases']);
        $this->modelData['other_value'] = convert_price($this->modelData['other_value']);
        $this->modelData['entry_date'] = Carbon::createFromFormat('d/m/Y', $request->entry_date)->format('Y-m-d');
        if(isset($request->close)){
            $this->modelData['close'] = $request->close == 'on' ? 1 : 0;
            $this->modelData['person_close_id'] = Auth::user()->id;
        }
        return $this;
    }
   

}