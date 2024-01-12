<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use App\Models\Privilege;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\TestMail;
use Redirect;

use DataTables;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {

        if (!(Privilege::checkPrivilege(6))) {
            return redirect()->route('dashboard')->with('error', 'You don\'t have Sufficient Permissions to Perform this Operation.');
        }

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
        if (!(Privilege::checkPrivilege(5))) {
            return redirect()->route('user-list')->with('error', 'You don\'t have Sufficient Permissions to Perform this Operation.');
        }

        if($this->loginUser()->role == 1){
            // $userRoles = Role::where('id', '<>', 1)->get();
            $userRoles = Role::whereNotIn('id', [1, 2, 3, 4])->get();
        }else{
            $loginUserRole = Role::where('id', $this->loginUser()->role)->first();
            $userRoles = Role::where('institute', $loginUserRole->institute)->whereNotIn('id', [1, 2, 3, 4])->get(); 
        }
        
        $branches = Branch::all();
        return view('user.createUser',['role' => $this->loginUser()->role, 'userRoles' => $userRoles, 'branches' => $branches]);
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
            'branch' => ['required'],
            
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
        $user->branch = $request->branch;
        $user->save();

        ActivityLog::createLog('Add new user to the system', Auth::id());
        return Redirect::to('/user/list')->with('success', "Cheers! New User Added Successfully.");
    }

    public function editUser($id)
    {
        if (!(Privilege::checkPrivilege(7))) {
            return redirect()->route('user-list')->with('error', 'You don\'t have Sufficient Permissions to Perform this Operation.');
        }

        $user = User::where('id', $id)->first();
        if($this->loginUser()->role == 1){
            $userRoles = Role::whereNotIn('id', [1, 2, 3, 4])->get();
        }else{
            $loginUserRole = Role::where('id', $this->loginUser()->role)->first();
            $userRoles = Role::where('institute', $loginUserRole->institute)->whereNotIn('id', [1, 2, 3, 4])->get();
        }

        $branches = Branch::all();
        return view('user.editUser',['role' => $this->loginUser()->role, 'user' => $user, 'userRoles' => $userRoles, 'branches' => $branches]);
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
            'branch' => ['required'],
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
                    'branch' => $request['branch'],
                ]);

        ActivityLog::createLog('Update details of user #'.$request['id'], Auth::id());
        return Redirect::to('/user/list')->with('success', 'User #'.$request['id'].' updated Successfully.');

    }

    public function viewUser($id)
    {
        if (!(Privilege::checkPrivilege(6))) {
            return redirect()->route('dashboard')->with('error', 'You don\'t have Sufficient Permissions to Perform this Operation.');
        }

        $user = User::join('roles', 'users.role', 'roles.id')
                    ->join('institutes', 'roles.institute', 'institutes.id')
                    ->where('users.id', $id)
                    ->first([
                        'users.*',
                        'roles.name as role_name',
                        'institutes.name as institutes_name',
                    ]);
        return view('user.viewUser', ['user'=>$user]);
    }

    public function myAccount()
    {
        $user = User::join('roles', 'users.role', 'roles.id')
                    ->join('institutes', 'roles.institute', 'institutes.id')
                    ->where('users.id', Auth::id())
                    ->first([
                        'users.*',
                        'roles.name as role_name',
                        'institutes.name as institutes_name',
                    ]);
        return view('user.myAccount', ['user'=>$user]);
    }

    public function deleteUser($id)
    {
        if (!(Privilege::checkPrivilege(8))) {
            return response()->json(['error' => 'You don\'t have Sufficient Permissions to Perform this Operation.'], 403);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        if ($user->role == 1 || $user->role == 2 || $user->role == 3) {
            return response()->json(['error' => 'Unauthorized Action.'], 403);
        }

        $user->delete();
        ActivityLog::createLog('Delete user #'.$id.' from the system', Auth::id());
        return response()->json(['success' => 'User #' . $id . ' deleted successfully.']);
    }
   
    public function loginUser()
    {
        return User::find(Auth::id());
    }

    public function testMail()
    {
        $details = [
            'name' => 'SDP Project',
            'email' => 'SDP Project test mail for the testing purposes',
            'mail' => 'pasanimeshka95@gmail.com',
        ];
        
        $this->sendTestMail($details);
        return view('mail.TestMail', ['data' => $details]);
    }

    public function sendTestMail($details)
    {
        return \Mail::to($details['mail'])->send(new TestMail($details));
    }
}
