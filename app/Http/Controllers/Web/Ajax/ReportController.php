<?php

namespace App\Http\Controllers\Web\Ajax;
use App\Traits\Loggable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;


class ReportController extends BaseController
{
    use Loggable;

    public function __construct(){}

    public function export(Request $request){
        try {
            dd($request);
        } catch (ModelNotFoundException $e) {
            flash()->error($e->getMessage());
        } catch(\Throwable $th) {
            return $this->handleWebLogException($th);
        }
    }
    
}
