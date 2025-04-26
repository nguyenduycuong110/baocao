<?php  
namespace App\Services\Impl\Merchandise;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Services\Interfaces\Merchandise\MerchandiseServiceInterface;
use App\Repositories\Merchandise\MerchandiseRepository;
use Illuminate\Support\Carbon;

class MerchandiseService extends BaseService implements MerchandiseServiceInterface{

    protected $repository;

    public function __construct(
        MerchandiseRepository $repository
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