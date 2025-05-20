<?php 
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\User\User\StoreRequest;
use App\Http\Requests\User\User\UpdateRequest;
use App\Http\Requests\User\User\UpdateProfileRequest;
use App\Http\Requests\User\User\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use App\Services\Interfaces\User\UserServiceInterface as UserService;
use App\Services\Interfaces\User\UserCatalogueServiceInterface as UserCatalogueService;
use App\Services\Interfaces\Area\ProvinceServiceInterface as ProvinceService;
use App\Services\Interfaces\Team\TeamServiceInterface as TeamService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use App\Services\Interfaces\Permission\PermissionServiceInterface as PermissionService;

class UserController extends BaseController{

    protected $namespace = 'user';
    protected $route = 'users';
    
    protected $service;
    protected $userCatalogueService;
    protected $provinceService;
    protected $teamService;
    protected $permissionService;

    public function __construct(
        UserService $service,
        UserCatalogueService $userCatalogueService,
        ProvinceService $provinceService,
        TeamService $teamService,
        PermissionService $permissionService
    )
    {
        $this->service = $service;
        $this->userCatalogueService = $userCatalogueService;
        $this->provinceService = $provinceService;
        $this->teamService = $teamService;
        $this->permissionService = $permissionService;
        parent::__construct($service);
    }

    public function store(StoreRequest $request): RedirectResponse{
        return $this->baseSave($request);
    }

    public function update(UpdateRequest $request, int $id){
        return $this->baseSave($request, $id);
    }

    public function resetPassword(Request $request, $id): View | RedirectResponse{
        try {
            $config = $this->config();
            return view("backend.{$this->namespace}.resetPassword", compact(
                'config',
                'id',
            ));
        } catch (\Throwable $th) {
            return $this->handleWebLogException($th);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request, $id): RedirectResponse{
        try {
            if($response = $this->service->updatePassword($request, $id)){
                flash()->success(Lang::get('message.save_success'));
                return redirect()->route("{$this->route}.index");
            }else{
                flash()->error(Lang::get('message.save_failed'));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return $this->handleWebLogException($th);
        }
    }

    public function profile(Request $request): View | RedirectResponse{
        try {
            $data = $this->getData();
            extract($data);
            $auth = Auth::user();
            $config = $this->config();
            $config['model'] = Str::studly(Str::singular($this->route));
            return view("backend.{$this->namespace}.profile", compact(
                'auth',
                'config',
                ...array_keys($data)
            ));
        } catch (\Throwable $th) {
            return $this->handleWebLogException($th);
        }
    }

    public function updateProfile(UpdateProfileRequest $request, $id): RedirectResponse{
        try {
            if($response = $this->service->updateProfile($request, $id)){
                flash()->success(Lang::get('message.save_success'));
                return redirect()->route("{$this->route}.index");
            }else{
                flash()->error(Lang::get('message.save_failed'));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return $this->handleWebLogException($th);
        }
    }

    protected function getData(): array{
        return [
            'user_catalogues' => isset($this->userCatalogueService) ? $this->userCatalogueService?->all() : null,
            'provinces' => isset($this->provinceService) ?  $this->provinceService->all() : null,
            'teams' =>  isset($this->teamService) ?  $this->teamService->teamPublish() : null,
            'permissions' => $this->permissionService?->all()
        ];
    }

    protected function config(){
        return [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/library/location.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'route' => $this->route
        ];
    }

}   