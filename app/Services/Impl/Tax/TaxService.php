<?php  
namespace App\Services\Impl\Tax;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Services\Interfaces\Tax\TaxServiceInterface;
use App\Repositories\Tax\TaxRepository;
use Illuminate\Support\Carbon;

class TaxService extends BaseService implements TaxServiceInterface{

    protected $repository;

    public function __construct(
        TaxRepository $repository
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