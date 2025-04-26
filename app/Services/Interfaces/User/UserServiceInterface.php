<?php   
namespace App\Services\Interfaces\User;
use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Http\Request;

interface UserServiceInterface extends BaseServiceInterface {
     
    public function updatePassword($request, ?int $id = null);

    public function updateProfile($request, ?int $id = null);

}