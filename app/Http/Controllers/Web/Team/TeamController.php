<?php 
namespace App\Http\Controllers\Web\Team;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Team\Team\StoreRequest;
use App\Http\Requests\Team\Team\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\Interfaces\Team\TeamServiceInterface as TeamService;
use App\Services\Interfaces\User\UserServiceInterface as UserService;


class TeamController extends BaseController{

    protected $namespace = 'team';
    protected $route = 'teams';

    protected $service;
    protected $userService;


    public function __construct(
        TeamService $service,
        UserService $userService,
    )
    {
        $this->service = $service;
        $this->userService = $userService;
        parent::__construct($service);
    }

    public function store(StoreRequest $request): RedirectResponse{
        return $this->baseSave($request);
    }
    
    public function update(UpdateRequest $request, int $id){
        return $this->baseSave($request, $id);
    }

    protected function getData(): array{
        return [
            'users' => $this->userService?->all(),
        ];
    }


}   