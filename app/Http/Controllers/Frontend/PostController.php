<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;

use App\Validators\CommentValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Models\Comment;

use Auth;
use DB;

class PostController extends Controller
{
    //

    protected $post;
    protected $validator;

    public function __construct(
        PostRepositoryInterface $post,
        CommentValidator $validator
    )
    {
        $this->post = $post;
        $this->validator = $validator;
    }

    public function index() {
        $data = $this->post->getAllPost();
        if(Auth::check()) {
            if(Auth::user()->cant('user')) {
                return redirect()->route('admin.home');
            }
        }
        return view('frontend.pages.post', compact('data'));
    }

    public function detail($id) {
        $data =  $this->post->detailPostAndPostOrther($id);
        return view('frontend.pages.post-detail', compact('data'));
    }

    public function postComment(Request $request, $id) {
        $dataForm = $request->all();
        try {
            $this->validator->with($dataForm)->passesOrFail(BaseValidatorInterface::RULE_CREATE);
        } catch (ValidatorException $e) {
           return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }

        try {
            $table = new Comment;
            $table->user_id =  Auth::id();
            $table->post_id =  $id;
            $table->content = $dataForm['content'];
            $table->save();
            DB::commit();
            return redirect()->back();
		} catch (\Exception $e) {
			DB::rollback();
            return redirect()->back();
		}
        return $dataForm;
    } 

    public function deteteComment($id) {
        Comment::where('id', $id)->where('user_id', Auth::id())->delete();
        return back();
    }
}
