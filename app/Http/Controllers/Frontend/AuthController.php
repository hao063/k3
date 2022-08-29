<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\User\UserRepositoryInterface;

use App\Validators\AuthValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Models\Permission;

use Auth;
use Hash;
use App\Jobs\ForgetPasswordJob;

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
        return view('frontend.pages.auth.login');
    }

    public function loginPost(Request $request) {
        $dataForm = $request->all();
        try {
            $this->validator->with($dataForm)->passesOrFail(BaseValidatorInterface::RULE_LOGIN);
        } catch (ValidatorException $e) {
           return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }

        $remember = isset($dataForm['remember']) ? true : false;
        $error = 'Incorrect account or password.';
        if (Auth::attempt(['email' => $dataForm['email'], 'password' => $dataForm['password']], $remember)) {
            
            if(Auth::user()->hasPermission(Permission::where('name', 'user')->first())) {
                return redirect()->route('home');
            }else {
                Auth::logout();
                $error = 'This account does not have admin rights!';
            }
        }
        return redirect()->back()->with('error', $error);
    }

    public function logout() {  
        Auth::logout();
        return redirect()->back();
    }

    public function forgetPassword($email = null) {
        $dataForm = null;
        if(!empty($email)) {
            $dataForm = urldecode($email);
        }
        return view('frontend.pages.auth.forget-password', compact('dataForm'));
    }

    public function forgetPasswordPost(Request $request) {
        $dataForm = $request->all();
        try {
            $this->validator->with($dataForm)->passesOrFail(BaseValidatorInterface::RULE_FORGET_PASSWORD);
        } catch (ValidatorException $e) {
           return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }

        $check = $this->user->checkUserForget($dataForm['email']);
        if($check) {
            $data = $this->user->addToken($dataForm['email']);
            $ForgetPasswordJob = new ForgetPasswordJob($data);
            dispatch($ForgetPasswordJob);      
            $email = urlencode($data->email);
            $hash = base64_encode(Hash::make($data->id));
            return redirect()
                    ->route('confirm.token.forget', compact('email', 'hash'))
                    ->with([
                        'success' => 'Please access your email to get the confirmation code',
                    ]);
        }

        return redirect()->back()->with('error', 'Email is not registered');
    }

    public function confirmTokenForget($email, $hash) {
        $check = $this->checkSessionView($email, $hash);
        if($check) {
            return view('frontend.pages.auth.confirm-token-forget', compact('email', 'hash'));
        }
        $data = 'frontend';
        return abort(404); 
    }

    public function confirmTokenForgetPost(Request $request) {
        $dataForm = $request->all();
        try {
            $this->validator->with($dataForm)->passesOrFail(BaseValidatorInterface::RULE_TOKEN);
        } catch (ValidatorException $e) {
           return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }

        $data = $this->user->checkTokenConfirm($dataForm);
        if(!empty($data)) {
            $email = urlencode($data->email);
            $hash = base64_encode(Hash::make($data->id));
            return redirect()->route('form.passwork.new.frontend', compact('email', 'hash'))->with('success', 'Confirmed successfully, please enter a new password');
        }
        return redirect()->back()->with('error', 'Tokens are incorrect');
    }   

    public function formPasswordNew($email, $hash) {
        $check_view_confirm = $this->checkSessionView($email, $hash);
        if($check_view_confirm) {
            return view('frontend.pages.auth.form-password-new', compact('email', 'hash'));
        }
        $data = 'frontend';
        return abort(404); 
    }

    public function checkSessionView($email, $hash) {
        $email = urldecode($email);
        $hash = base64_decode($hash);
        $check_view_confirm = $this->user->checkViewConfirm($email, $hash);
        if(!$check_view_confirm) {
            return false;
        }
        return true;
    }

    public function postPasswordNew(Request $request) {
        $dataForm = $request->all();
        try {
            $this->validator->with($dataForm)->passesOrFail(BaseValidatorInterface::RULE_PASSWORD);
        } catch (ValidatorException $e) {
           return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }

        $data = $this->user->upadtePassword($dataForm);
        if(!empty($data)) {
            return redirect()->route('login.frontend')->with('success', 'successful, please login to use the service.');
        }
        return abort(404); 
    }
}
