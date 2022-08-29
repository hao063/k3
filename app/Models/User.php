<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Permission;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function hasPermission(Permission $permission) {
        $data = Auth()->user()->roles;
        $status = false;
        foreach ($data as $role) {
            if(optional($role->permissions)->contains($permission)) {
                $status = true;
            }
        }
        return $status;
    }

    public function permissions($type = 0, $roles = []) {
        if($type == 0) {
            $data = Auth()->user()->roles;
        }else {
            $data = $roles;
        }
        $data_permissions = [];
        foreach ($data as $role) {
            foreach ($role->permissions->toArray() as  $value) {
                $data_permissions[] = $value['name'];
            }
        }
        return array_unique($data_permissions);
    }

    public function hasViewPermission($permission) {
        $permission = Permission::where('name', $permission)->first();
        if(empty($permission)) return false;
        return $this->hasPermission($permission);
    }
}
