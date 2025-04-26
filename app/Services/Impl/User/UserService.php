<?php  
namespace App\Services\Impl\User;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Services\Interfaces\User\UserServiceInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService extends BaseService implements UserServiceInterface{

    protected $repository;
    protected $route = 'users';

    public function __construct(
        UserRepository $repository
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

    public function updatePassword($request , ?int $id = null){
        if(!$this->repository->findById($id)){
            throw new ModelNotFoundException(Lang::get('message.not_found'));
        }
        $payload = [
            'password' => Hash::make($request->password),
        ];
        return $this->repository->updatePassword($payload, $id);
    }
    
    public function updateProfile($request , ?int $id = null){
        if(!$this->repository->findById($id)){
            throw new ModelNotFoundException(Lang::get('message.not_found'));
        }
        $payload = $request->except('password');
        if($request->has('password') && $request->password) {
            $payload['password'] = Hash::make($request->password);
        }
        return $this->repository->update($id, $payload);
    }

}