<?php
namespace App\Repositories\Role;

use App\Repositories\BaseRepository;
use App\Models\PermissionRole;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Role::class;
    }

    public function addPermisstionToRole($id, $permission_ids) {
        $data = [];
        foreach ($permission_ids as $permission_id) {
            $data[] = [
                'permission_id' => $permission_id,
                'role_id' => $id
            ];
        }
        PermissionRole::insert($data);
        return true;
    }
    public function getAllRole() {
        return $this->model->with('permissions')->get()->toArray();
    }

    public function findDetailRole($id) {
        return $this->model->select('id','name')->with([
            'permissions' => function ($q) {
                $q->select('id')->pluck('id');
            }
        ])->where('id', $id)->first(); 
    }

    public function updatePermissionRole($id, $permission_ids) {
        PermissionRole::where('role_id', $id)->delete();
        $this->addPermisstionToRole($id, $permission_ids);
        return true;
    }
}