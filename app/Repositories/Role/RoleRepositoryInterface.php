<?php
namespace App\Repositories\Role;
    
use App\Repositories\RepositoryInterface;
        
interface RoleRepositoryInterface extends RepositoryInterface
{
    public function addPermisstionToRole($id, $permission_ids);

    public function getAllRole();

    public function findDetailRole($id);

    public function updatePermissionRole($id, $permission_ids);
}