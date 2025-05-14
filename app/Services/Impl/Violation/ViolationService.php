<?php  
namespace App\Services\Impl\Violation;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Services\Interfaces\Violation\ViolationServiceInterface;
use App\Repositories\Violation\ViolationRepository;
use Illuminate\Support\Carbon;

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
        $this->modelData['entry_date'] = Carbon::createFromFormat('d/m/Y', $request->entry_date)->format('Y-m-d');
        return $this;
    }
   

}