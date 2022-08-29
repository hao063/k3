<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;

use App\Validators\UserValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hash;
use DB;
use Auth;

class UserController extends Controller
{

    protected $user;
    protected $validator;
    protected $role;

    public function __construct(
        RoleRepositoryInterface $role, 
        UserRepositoryInterface $user, 
        UserValidator $validator
    )
    {
        $this->user = $user;
        $this->role = $role;
        $this->validator = $validator;
        $this->middleware('permission:manager-user', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->checkAuthorController(['manager-user', 'read-user'])) {
            $data = $this->user->getAllUser();  
            return view('admin.pages.users.index', compact('data'));
        }
        return abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data_role = $this->role->getAll()->toArray();
        return view('admin.pages.users.create', compact('data_role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $dataForm = $request->all();
        try {
            $this->validator->with($dataForm)->passesOrFail(BaseValidatorInterface::RULE_CREATE);
        } catch (ValidatorException $e) {
           return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
        DB::beginTransaction();
		try {
            $role_ids = $dataForm['role_ids'];
            unset($dataForm['role_ids']);
            $dataForm['password'] = Hash::make($dataForm['password']);

            $user = $this->user->create($dataForm);
            $this->user->addRoleUser($user->id, $role_ids);
            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'Tạo mới thành công.');
		} catch (\Exception $e) {
			DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $dataForm = $this->user->findDetailUser($id);
        $data_role = $this->role->getAll()->toArray();
        // dd($dataForm);
        return view('admin.pages.users.edit', compact('data_role', 'dataForm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $dataForm = $request->all();
        try {
            $this->validator->with($dataForm)->setId($id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
           return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
        DB::beginTransaction();
		try {
            $role_ids = $dataForm['role_ids'];
            unset($dataForm['role_ids']);
            $user = $this->user->update($id, $dataForm);
            $this->user->updateRoleUser($id, $role_ids);
            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'Sửa thành công.');
		} catch (\Exception $e) {
			DB::rollback();
            return redirect()->back()->with('danger', $e->getMessage());
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->user->delete($id);
        return back()->with('success', 'Bạn đã xoá thành công.');
    }
}
