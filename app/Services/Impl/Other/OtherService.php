<?php  
namespace App\Services\Impl\Other;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Services\Interfaces\Other\OtherServiceInterface;
use App\Repositories\Other\OtherRepository;
use Illuminate\Support\Carbon;

class OtherService extends BaseService implements OtherServiceInterface{

    protected $repository;

    public function __construct(
        OtherRepository $repository
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