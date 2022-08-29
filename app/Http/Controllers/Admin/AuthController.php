<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Repositories\User\UserRepositoryInterface;

use App\Validators\AuthValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Models\Permission;

use Auth;
use Hash;
use DB;

class AuthController extends Controller
{
    //
    protected $user;
    protected $validator;

    public function __construct(
        UserRepositoryInterface $user, 
        AuthValidator $validator
        )
    {
        $this->validator = $validator;
        $this->user = $user;
    }

    public function login() {
        if(Auth::check()) {
            if(Auth::user()->cant('admin')) {
                return redirect()->route('home');
            }else {
                return redirect()->route('admin.home');
            }
        }
        return view('admin.pages.auth.login');
    }

    public function postLogin(Request $request) {
        $dataForm = $request->all();

        try {
            $this->validator->with($dataForm)->passesOrFail(BaseValidatorInterface::RULE_LOGIN);
        } catch (ValidatorException $e) {
           return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
        $remember = isset($dataForm['remember']) ? true : false;
        $error = 'Incorrect account or password.';
        if (Auth::attempt(['email' => $dataForm['email'], 'password' => $dataForm['password']], $remember)) {
            if(Auth::user()->hasPermission(Permission::where('name', 'admin')->first())) {
                return redirect()->route('admin.home');
            }else {
                Auth::logout();
                $error = 'This account does not have admin rights!';
            }
        }
        return redirect()->back()->with('error', $error);
    }

    public function logout() {
        if(Auth::check()) {
            Auth::logout();
            return redirect()->route('admin.login');
        }
        return abort(404);
    }
}
