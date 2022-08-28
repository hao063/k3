<?php
namespace App\Repositories\Post;

use App\Repositories\BaseRepository;

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
}