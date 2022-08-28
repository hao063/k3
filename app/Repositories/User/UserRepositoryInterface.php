<?php
namespace App\Repositories\User;
    
use App\Repositories\RepositoryInterface;
        
interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAllUser();

    public function addRoleUser($id, $role_ids);  

    public function findDetailUser($id);

    public function updateRoleUser($id, $role_ids);

    public function checkUserForget($email);

    public function addToken($email);

    public function checkViewConfirm($email, $hash);

    public function checkTokenConfirm($dataForm);

    public function upadtePassword($dataForm);
}