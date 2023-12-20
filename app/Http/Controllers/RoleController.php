<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Institute;
use App\Models\Privilege;
use App\Models\RolePrivilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class RoleController extends Controller
{

    public function index()
    { 
        if (!(Privilege::checkPrivilege(2))) {
            return redirect()->route('dashboard')->with('error', 'You don\'t have Sufficient Permissions to Perform this Operation.');
        }

        $currentUserRole = Role::find($this->loginUser()->role);

        if($currentUserRole->id == 1){
            $roles = Role::join('institutes', 'roles.institute', 'institutes.id')
                        ->get([
                            'roles.*',
                            'institutes.name as institutes_name',
                        ]);  
        }else{
            $roles = Role::join('institutes', 'roles.institute', 'institutes.id')
                    ->where('institute', $currentUserRole->institute)
                    ->get([
                        'roles.*',
                        'institutes.name as institutes_name',
                    ]);      
        }

        
        return view('roles.index',['roles' => $roles]);
    }

    public function createRole(Request $request)
    {
        if (!(Privilege::checkPrivilege(1))) {
            return redirect()->route('role-list')->with('error', 'You don\'t have Sufficient Permissions to Perform this Operation.');
        }

        if($this->loginUser()->role == 1){
            $userPrivileges = Privilege::all();
        }else{
            if($this->loginUser()->role == 2 || $this->loginUser()->role == 3){
                $userPrivileges = Privilege::whereNotIn('id', [1, 3, 4])->get();
            }else{
                $userPrivileges = Privilege::whereNotIn('id', [1, 2, 3, 4])->get();
            }      
        }

        $institutes = Institute::where('id', '<>', 0)->get();
        return view('roles.createRole',['role' => $this->loginUser()->role, 'institutes' => $institutes, 'userPrivileges' => $userPrivileges]);
    }

    public function saveRole(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
        ]);

        // var_dump(json_encode($request['privileges']));die();

        if($this->loginUser()->role == 1){
            $institute = $request['institute'];
        }else{
            $currentUserRole = Role::find($this->loginUser()->role);
            $institute = $currentUserRole->institute;
        }

        $data = Role::create([
            'name' => $request['name'],
            'institute' => $institute,
            'description' => $request['description'],
        ]);

        if ($request->has('privileges')) {

            RolePrivilege::create([
                'role_id' => $data->id,
                'privileges' => json_encode($request['privileges'])
            ]);
        }

        return Redirect::to('/role/list')->with('success', 'Role saved Successfully.');
    }

    public function editRole($id)
    {
        if (!(Privilege::checkPrivilege(3))) {
            return redirect()->route('role-list')->with('error', 'You don\'t have Sufficient Permissions to Perform this Operation.');
        }

        if($this->loginUser()->role == 1){
            $userPrivileges = Privilege::all();
        }else{
            if($this->loginUser()->role == 2 || $this->loginUser()->role == 3){
                $userPrivileges = Privilege::whereNotIn('id', [1, 3, 4])->get();
            }else{
                $userPrivileges = Privilege::whereNotIn('id', [1, 2, 3, 4])->get();
            }      
        }

        $currentPrivilegeIds = null;
        $roleModel = Role::where('id', $id)->first();
        $rolePrivileges = RolePrivilege::where('role_id', $roleModel->id)->first();
        if ($rolePrivileges) {
            $currentPrivilegeIds = json_decode($rolePrivileges->privileges, true);
        }
        // var_dump($currentPrivilegeIds);die();
        return view('roles.editRole',['roleModel' => $roleModel, 'userPrivileges' => $userPrivileges, 'currentPrivilegeIds' => $currentPrivilegeIds]);
    }

    public function updateRole(Request $request)
    {

        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
        ]);

        Role::where('id', $request['id'])
                ->update([
                    'name' => $request['name'],
                    'description' => $request['description']
                ]);

        $rolePrivileges = RolePrivilege::where('role_id', $request['id'])->first();
        $newPrivilegeIds = $request['privileges'];

        if($newPrivilegeIds){
            if ($rolePrivileges) {
                $rolePrivileges->update([
                    'privileges' => json_encode($newPrivilegeIds)
                ]);
            } else {
                RolePrivilege::create([
                    'role_id' => $request['id'],
                    'privileges' => json_encode($newPrivilegeIds)
                ]);
            }

        }else{
            RolePrivilege::where('role_id', $request['id'])->delete();
        }

        return Redirect::to('/role/list')->with('success', 'Role #'.$request['id'].' updated Successfully.');

    }

    public function viewRole($id)
    {
        $privileges = null;
        $role = Role::join('institutes', 'roles.institute', 'institutes.id')
                        ->where('roles.id', $id)
                        ->first([
                            'roles.*',
                            'institutes.name as institutes_name',
                        ]);

        $rolePrivilege = RolePrivilege::where('role_id', $id)->first();
        if($rolePrivilege){
            $privileges = json_decode($rolePrivilege->privileges);
        }
        // var_dump($privileges);die();
        return view('roles.viewRole', ['role'=>$role, 'privileges' => $privileges]);
    }

    public function deleteRole($id)
    {
        if (!(Privilege::checkPrivilege(4))) {
            return response()->json(['error' => 'You don\'t have Sufficient Permissions to Perform this Operation.'], 403);
        }

        if($id == 1 || $id == 2 || $id == 3 || $id == 4){
            return response()->json(['error' => 'Unauthorized Action.'], 403);
        }

        $roleUsers = User::where('role', $id)->get();
        if(count($roleUsers) > 0){
            return response()->json(['error' => 'Sorry! This Role has Accounts.'], 403);
        }

        Role::where('id', $id)->delete();
        RolePrivilege::where('role_id', $id)->delete();

        return response()->json(['success' => 'Role #'.$id.' deleted Successfully.']);
    }

    public function loginUser()
    {
        return User::find(Auth::id());
    }
    
}
