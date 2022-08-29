<?php
namespace App\Repositories\Post;
    
use App\Repositories\RepositoryInterface;
        
interface PostRepositoryInterface extends RepositoryInterface
{
    public function getAllPost();

    public function removeImgOld($id);

    public function finDetalPost($id);

    public function detailPostAndPostOrther($id); 
}