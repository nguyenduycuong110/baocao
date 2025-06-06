<?php  
namespace App\Http\Controllers\Web\Report;

use App\Http\Controllers\Controller;
use App\Traits\Loggable;
use App\Services\Interfaces\Auth\AuthWebServiceInterface as AuthService;

class ReportController extends Controller{

    use Loggable;

    private $authService;

    public function __construct(
        AuthService $authService,
    ){
        $this->authService = $authService;
    }

    public function index(){
        return view('backend.report.index');
    }

}