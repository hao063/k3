<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\RoleUser;
use Hash;
use Auth;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getAllUser(){
        return $this->model->with('roles')->get()->toArray();
    }

    public function addRoleUser($id, $role_ids){
        $data = [];
        foreach ($role_ids as $role_id) {
            $data[] = [
                'user_id' => $id,
                'role_id' => $role_id
            ];
        }
        RoleUser::insert($data);
        return true;
    }

    public function findDetailUser($id) {
        return $this->model->select('id','name')->with([
            'roles' => function ($q) {
                $q->select('id')->pluck('id');
            }
        ])->where('id', $id)->first()->toArray();
    }

    public function updateRoleUser($id, $role_ids) {
        RoleUser::where('user_id', $id)->delete();
        $this->addRoleUser($id, $role_ids);
        return true;
    }  
    
    public function checkUserForget($email) {
        $data = $this->model->where('email', $email)->first();
        if(!empty($data) && count(array_intersect(['user'], $data->permissions(1, $data->roles))) > 0 ) {
            return true;
        }
        return false;
    }

    public function addToken($email) {
        $data = $this->model->where('email', $email)->first();
        if($data->updated_at < now()->addMinutes(-5)->toDateTimeString() || $data->token == 1){
            $data->token = rand(100000, 999999);
            $data->updated_at = now();
            $data->save();
        }
        return $data;
    }

    public function checkViewConfirm($email, $hash) {
        $data = $this->model->where('email', $email)->first();
        if(!empty($data) && Hash::check($data->id, $hash)) {
            return true;
        }
        return false;
    }

    public function checkTokenConfirm($dataForm) {
        $data = $this->model->where('email', $dataForm['email'])
                                ->where('token', $dataForm['token'])
                                ->where('token', '<>', 1)
                            ->first();
        if(!empty($data) && Hash::check($data->id, base64_decode($dataForm['hash']))) {
            $data->token = 1;
            $data->save();
            return $data;
        }
        return [];
    }

    public function upadtePassword($dataForm) {
        $data = $this->model->where('email', $dataForm['email'])->where('token', 1)->first();
        if(!empty($data) && Hash::check($data->id, base64_decode($dataForm['hash']))) {
            $data->password = Hash::make($dataForm['password']);
            $data->save();
            return $data;
        }
        return [];
    }
}