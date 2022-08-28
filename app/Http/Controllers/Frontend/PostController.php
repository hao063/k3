<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;


class PostController extends Controller
{
    //

    protected $post;

    public function __construct(PostRepositoryInterface $post)
    {
        $this->post = $post;
    }

    public function index() {
        $data = $this->post->getAll()->toArray();
        return view('frontend.pages.post', compact('data'));
    }

    

}
