<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Permission\PermissionRepositoryInterface;

use App\Validators\RoleValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use DB;
use Auth;

class RoleController extends Controller
{
    protected $role;
    protected $validator;
    protected $permission;

    public function __construct(
        RoleRepositoryInterface $role, 
        PermissionRepositoryInterface $permission, 
        RoleValidator $validator
    )
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->validator = $validator;
        $this->middleware('permission:manager-role-permission', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if($this->checkAuthorController(['manager-role-permission'])) {
            $data = $this->role->getAllRole();
            return view('admin.pages.roles.index', compact('data'));
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
        $data_permission = $this->permission->getAll()->toArray();
        return view('admin.pages.roles.create', compact('data_permission'));
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
            $permission_ids = $dataForm['permission_ids'];
            unset($dataForm['permission_ids']);
            $role = $this->role->create($dataForm);
            $this->role->addPermisstionToRole($role->id, $permission_ids);
            DB::commit();
            return redirect()->route('admin.role.index');
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
        $data_permission = $this->permission->getAll()->toArray();
        $dataForm = $this->role->findDetailRole($id);
        // return $dataForm;
        return view('admin.pages.roles.edit', compact('data_permission', 'dataForm'));
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
        $dataForm = $request->all();
        try {
            $this->validator->with($dataForm)->setId($id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
           return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
        DB::beginTransaction();
		try {
            $permission_ids = $dataForm['permission_ids'];
            unset($dataForm['permission_ids']);
            $role = $this->role->update($id, $dataForm);
            $this->role->updatePermissionRole($id, $permission_ids);
            DB::commit();
            return redirect()->route('admin.role.index')->with('success', 'Sửa thành công.');
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
    }
}
