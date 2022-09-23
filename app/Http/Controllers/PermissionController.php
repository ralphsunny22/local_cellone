<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{

    public function test()
    {
        $role = Role::find('1');
        // return $role->hasPermission('create-site');
        $role_permissions = $role->permissions;
        $permissions = Permission::where('parent_id', null)->get();
        return view('test', compact('permissions', 'role', 'role_permissions'));
    }
    public function testPost(Request $request)
    {
        $role = Role::find('1');
        $users = $role->users()->get();
        $data = $request->all();
        $perms_unchecked = $data['perms_unchecked'];

        //remove unchecked perms
        foreach ($data['perms_unchecked'] as $key => $unchecked_id) {
            if ($unchecked_id != null){
                DB::table('roles_permissions')->where(['role_id'=>$role->id, 'permission_id'=>$data['perms_unchecked'][$key]])->delete();

                if(count($users) > 0){
                    foreach ($users as $user) {
                        DB::table('users_permissions')->where(['user_id'=>$user->id, 'permission_id'=>$data['perms_unchecked'][$key]])->delete();
                    }
                }
            }
            
        }
        
        //added checked perms
        foreach ($data['perms'] as $key => $perm_id) {
            $rolePerms = DB::table('roles_permissions')->where(['role_id'=>$role->id, 'permission_id'=>$data['perms'][$key]])->first();
            if (!isset($rolePerms)){
                $role->permissions()->attach($perm_id);
            }
             //adding to roles_permissions
        }
        return back();
    }
    public function testuser()
    {
        $role = Role::find('1');
        $user = User::find('2');
        $user_permissions = $user->permissions;
        //return $user->hasPermission('3');
        $role_permissions = $role->permissions;
        // return $role_permissions[0]['parent_id'];
        $permissions = Permission::where('parent_id', null)->get();
        return view('testuser', compact('permissions', 'role', 'role_permissions', 'user'));
    }
    public function testuserPost(Request $request)
    {
        $role = Role::find('1');
        $user = User::find('2');

        //attach user-role
        if(!$user->hasRole($role->slug)){
            $user->roles()->attach($role);
        }
         
        $data = $request->all();

        //remove unchecked perms
        foreach ($data['perms_unchecked'] as $key => $unchecked_id) {
            if ($unchecked_id != null){
                DB::table('users_permissions')->where(['user_id'=>$user->id, 'permission_id'=>$data['perms_unchecked'][$key]])->delete();
            }
            
        }

        foreach ($data['perms'] as $key => $perm_id) {
            $userPerms = DB::table('users_permissions')->where(['user_id'=>$user->id, 'permission_id'=>$data['perms'][$key]])->first();
            if (!isset($userPerms)){
                $user->permissions()->attach($perm_id);
            }
             //adding to roles_permissions
        }
        return back();
    }
    
    public function addPermsToRole()
    {
        //add/edit permissions to role. Duplicate perms already handled in line 23
        $dev_permission = Permission::select('id')->take(3)->get();
        $role = Role::find('1');
        $role->permissions;
        //$role->permissions()->delete();
        // $role->permissions()->attach($dev_permission);
        foreach ($dev_permission as $key => $perm) {
            $rolePerms = DB::table('roles_permissions')->where(['role_id'=>$role->id, 'permission_id'=>$perm->id])->first();
            if (!isset($rolePerms)){
                $role->permissions()->attach($perm->id);
            }
             //adding to roles_permissions
        }
        return 'done';
    }

    public function removeRolePerm(){
        $role = Role::find('1');
        $perm = Permission::find('1');
        $users = $role->users;

        if(count($users) > 0){
            foreach ($users as $key => $user) {
                $user->permissions()->detach($perm);
            }
        }
        $role->permissions()->detach($perm);
        return 'permission removed successfully';
        
    }

    //fresh role n perms to user, or change user role entirely
    public function addRoleAndPermsToUser()
    {
        $user = User::find('2');
        $role = Role::find('1');
        $permissions = $role->permissions;

        if ($user->hasRole($role->slug)) {
            return 'role already assigned to user';
        }
        $user->roles()->attach($role);
		$user->permissions()->attach($permissions);

    }

    //when user already has role, to alter his perms
    public function alterPerms()
    {
        $user = User::find('2');
        $role = Role::find('1');
        $permissions = $role->permissions;
        $user->permissions()->delete();
        return 'ccc';
        foreach ($permissions as $key => $perm) {
            $userPerms = DB::table('users_permissions')->where(['user_id'=>$user->id, 'permission_id'=>$perm->id])->first();
            if (!isset($userPerms)){
                $user->permissions()->attach($perm->id);
            }
             //adding to roles_permissions
        }
    }

    public function userCan(){
        $user = $user = User::find('2');
        dd($user->hasRole('manager-1')); //will return true, if user has role //important
        //dd($user->givePermissionsTo('create-site'));// will return permission, if not null //not important
        dd($user->can('create-site')); // will return true, if user has permission //important
    }

    

    public function Permission()
    {   
    	$dev_permission = Permission::where('slug','create-site')->first();
		$manager_permission = Permission::where('slug', 'edit-site')->first();

		//RoleTableSeeder.php
		$dev_role = new Role();
		$dev_role->name = 'Developer';
		$dev_role->slug = 'developer.1'; //'.1' is tenant-id, to avoid names collision
        $dev_role->tenant_id = 1;
		$dev_role->save();
		$dev_role->permissions()->attach($dev_permission);

		$manager_role = new Role();
		$manager_role->name = 'Manager';
		$manager_role->slug = 'manager.1';
        $dev_role->tenant_id = 1;
		$manager_role->save();
		$manager_role->permissions()->attach($manager_permission);
        ///////////////////////////////////////////////////////

        //same as above to fill roles_permissions tbl
		$dev_role = Role::where('slug','developer')->first();
		$manager_role = Role::where('slug', 'manager')->first();
        
		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($dev_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($manager_role);
        /////////////////////////////////////////////////////////

		$dev_role = Role::where('slug','developer')->first();
		$manager_role = Role::where('slug', 'manager')->first();
		$dev_perm = Permission::where('slug','create-tasks')->first();
		$manager_perm = Permission::where('slug','edit-users')->first();
        
		$developer = new User();
		$developer->name = 'Mahedi Hasan';
		$developer->email = 'mahedi@gmail.com';
		$developer->password = bcrypt('secrettt');
		$developer->save();
		$developer->roles()->attach($dev_role);
		$developer->permissions()->attach($dev_perm);

		$manager = new User();
		$manager->name = 'Hafizul Islam';
		$manager->email = 'hafiz@gmail.com';
		$manager->password = bcrypt('secrettt');
		$manager->save();
		$manager->roles()->attach($manager_role);
		$manager->permissions()->attach($manager_perm);

		
		return redirect()->back();
    }
}
