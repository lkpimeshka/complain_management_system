<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;

use DataTables;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        if($this->loginUser()->role == 1){
            $user = User::all();
        }else{
            $loginUserRole = Role::find($this->loginUser()->id);
            $user = User::join('roles', 'users.role', 'roles.id')
                            ->where('roles.institute', $loginUserRole->institute)
                            ->get(['users.*']);
        }

        return view('user.index', ['role' => $this->loginUser()->role, 'users' =>  $user]);
    }

    public function createUser(Request $request)
    {
        if($this->loginUser()->role == 1){
            $userRoles = Role::where('id', '<>', 1)->get();
        }else{
            $loginUserRole = Role::where('id', $this->loginUser()->role)->first();
            $userRoles = Role::where('institute', $loginUserRole->institute)->whereNotIn('id', [1, 2, 3])->get();
        }
        
        return view('user.createUser',['role' => $this->loginUser()->role, 'userRoles' => $userRoles]);
    }

    public function saveUser(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            'telephone' => ['required', 'string', 'min:10'],
            'nic' => ['required', 'string'],
            'address_line_1' => ['required', 'string', 'max:512'],
            'city' => ['required', 'string', 'max:255'],
            
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->telephone = $request->telephone;
        $user->nic = $request->nic;
        $user->address_line_1 = $request->address_line_1;
        $user->address_line_2 = $request->address_line_2;
        $user->city = $request->city;
        $user->save();

        return Redirect::to('/user/list')->with('success', "Cheers! New User Added Successfully.");
    }

    public function editUser($id)
    {
        $user = User::where('id', $id)->first();
        if($this->loginUser()->role == 1){
            $userRoles = Role::where('id', '<>', 1)->get();
        }else{
            $loginUserRole = Role::where('id', $this->loginUser()->role)->first();
            $userRoles = Role::where('institute', $loginUserRole->institute)->whereNotIn('id', [1, 2, 3])->get();
        }

        return view('user.editUser',['role' => $this->loginUser()->role, 'user' => $user, 'userRoles' => $userRoles]);
    }

    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'telephone' => 'required',
            'nic' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
        ]);

        User::where('id', $request['id'])
                ->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'role' => $request['role'],
                    'telephone' => $request['telephone'],
                    'nic' => $request['nic'],
                    'address_line_1' => $request['address_line_1'],
                    'address_line_2' => $request['address_line_2'],
                    'city' => $request['city'],
                ]);

        return Redirect::to('/user/list')->with('success', 'User #'.$request['id'].' updated Successfully.');

    }

    public function viewUser($id)
    {
        $user = User::join('roles', 'users.role', 'roles.id')
                    ->join('institutes', 'roles.institute', 'institutes.id')
                    ->where('roles.id', $id)
                    ->first([
                        'users.*',
                        'roles.name as role_name',
                        'institutes.name as institutes_name',
                    ]);
        return view('user.viewUser', ['user'=>$user]);
    }

    public function deleteUser($id)
    {

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        if ($user->role == 1 || $user->role == 2 || $user->role == 3) {
            return response()->json(['error' => 'Unauthorized Action.'], 403);
        }

        $user->delete();
        return response()->json(['success' => 'User #' . $id . ' deleted successfully.']);
    }
   
    public function loginUser()
    {
        return User::find(Auth::id());
    }
}
