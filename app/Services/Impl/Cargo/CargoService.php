<?php  
namespace App\Services\Impl\Cargo;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Services\Interfaces\Cargo\CargoServiceInterface;
use App\Repositories\Cargo\CargoRepository;

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
        return $this->initializeBasicData($request);
    }

    private function initializeBasicData(Request $request): self {
        $fillable = $this->repository->getFillable();
        $this->modelData = $request->only($fillable);
        return $this;
    }
   

}