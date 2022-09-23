<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function roles() {
      return $this->belongsToMany(Role::class,'roles_permissions');
    }
     
     public function users() {
      return $this->belongsToMany(User::class,'users_permissions');
     }

     //$perm->permissions, for sub_permissions
     public function permissions() {
      return $this->hasMany(Permission::class, 'parent_id', 'id'); //mapping permissions to its 'parent_id'
     }

     public function parent_perm()
    {
        return $this->belongsTo(Permission::class, 'parent_id', 'id'); //mapping permissions to its 'parent_id'
    }
}
