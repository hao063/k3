<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkAuthorController($permissions) {
        $permission_user = Auth::user()->permissions();
        $permissions[] = 'supper-admin';
        return count(array_intersect($permissions, $permission_user)) > 0;
    }
}
