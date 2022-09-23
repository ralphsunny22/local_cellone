<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Permissions\HasPermissionsTrait;

class Role extends Model
{
    use HasFactory, HasPermissionsTrait;

    public function permissions() {

        return $this->belongsToMany(Permission::class,'roles_permissions');
            
     }
     
     public function users() {
     
        return $this->belongsToMany(User::class,'users_roles');
            
     }

     public function hasPermission($permission_id) {

      return (bool) $this->permissions->where('id', $permission_id)->count();
    }

    
}
