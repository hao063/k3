<?php
namespace App\Repositories\Post;

use App\Repositories\BaseRepository;
use App\Models\Comment;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Post::class;
    }

    public function getAllPost() {
        return $this->model->with(['user'])->get()->toArray();
    }

    public function removeImgOld($id) {
        $data = $this->model->find($id);
        unlink($data->img);
        return true;
    }

    public function finDetalPost($id) {
        return $this->model->with('user')->where('id', $id)->first();
    }

    public function detailPostAndPostOrther($id) {
        $data = [];
        $data['post-detail'] = $this->model->with('user')->where('id', $id)->first()->toArray();
        $data['posts-orther'] = $this->model->with('user')->where('id', '<>', $id)->limit(3)->orderBy('id', 'DESC')->get()->toArray();
        $data['comments'] = Comment::with('user')->where('post_id', $id)->orderBy('id', 'DESC')->get()->toArray();
        return $data;
    }
}