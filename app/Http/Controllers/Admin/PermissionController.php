<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Permission\PermissionRepositoryInterface;

use App\Validators\PermissionValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use DB;

class PermissionController extends Controller
{

    protected $permission;
    protected $validator;

    public function __construct(PermissionRepositoryInterface $permission, PermissionValidator $validator)
    {
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
            $data = $this->permission->getAll();
            return view('admin.pages.permissions.index', compact('data'));
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
        return view('admin.pages.permissions.create');
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
            $permission = $this->permission->create($dataForm);
            DB::commit();
            
            return redirect()->route('admin.permission.index');
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
