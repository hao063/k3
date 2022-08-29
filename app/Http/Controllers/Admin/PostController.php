<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

use App\Validators\PostValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


use DB;
use Auth;
use App\Models\Post;

class PostController extends Controller
{
    protected $post;
    protected $user;
    protected $validator;

    public function __construct(
        PostRepositoryInterface $post, 
        UserRepositoryInterface $user,
        PostValidator $validator
        )
    {
        $this->post = $post;
        $this->user = $user;
        $this->validator = $validator;
        $this->middleware('permission:manager-post', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->checkAuthorController(['manager-post', 'read-post'])) {
            $data = $this->post->getAllPost();
            return view('admin.pages.posts.index', compact('data'));
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
        $data_user = $this->user->getAll()->toArray();
        return view('admin.pages.posts.create', compact('data_user'));
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
            $dataForm['user_id'] = Auth::id();
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $store_path = "uploads/";
                $name = md5(uniqid(rand(), true)) . str_replace(' ', '-', $image->getClientOriginalName());
                $image->move(public_path('/' . $store_path), $name);
                $dataForm['img'] = $store_path . '/' . $name;
            }
            $post = $this->post->create($dataForm);
            DB::commit();
            return redirect()->route('admin.post.index')->with('success', 'Tạo Post thành công');
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
        $dataForm = $this->post->finDetalPost($id);
        return view('admin.pages.posts.show', compact('dataForm'));
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
        $data_user = $this->user->getAll()->toArray();
        $dataForm = $this->post->find($id);
        return view('admin.pages.posts.edit', compact('data_user', 'dataForm'));
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
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $store_path = "uploads/";
                $name = md5(uniqid(rand(), true)) . str_replace(' ', '-', $image->getClientOriginalName());
                $image->move(public_path('/' . $store_path), $name);
                $dataForm['img'] = $store_path . '/' . $name;
                $this->post->removeImgOld($id);
            }
            $post = $this->post->update($id, $dataForm);
            DB::commit();
            return redirect()->route('admin.post.index')->with('success', 'Tạo Post thành công');
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
        $this->post->removeImgOld($id);    
        $this->post->delete($id);
        return back()->with('success', 'Đã xoá thành công');
    }
}
