<?php  
namespace App\Services\Impl\Unit;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Services\Interfaces\Unit\UnitServiceInterface;
use App\Repositories\Unit\UnitRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UnitService extends BaseService implements UnitServiceInterface{

    protected $repository;

    public function __construct(
        UnitRepository $repository
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
        $this->modelData['entry_date'] = Carbon::createFromFormat('d/m/Y', $request->entry_date)->format('Y-m-d');
        if(isset($request->close)){
            $this->modelData['close'] = $request->close == 'on' ? 1 : 0;
            $this->modelData['person_close_id'] = Auth::user()->id;
        }
        return $this;
    }
   

}