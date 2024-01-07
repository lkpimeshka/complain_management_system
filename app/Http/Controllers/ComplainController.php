<?php

namespace App\Http\Controllers;
use App\Models\Complain;
use App\Models\User;
use App\Models\Branch;
use App\Models\Role;
use App\Models\Institutes;
use App\Models\Attachment;
use App\Models\Assign;
use App\Models\Privilege;
use App\Models\RolePrivilege;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class ComplainController extends Controller
{

    public function index()
    {
        if($this->loginUser()->role == 1){
            $complaints = Complain::all();
        } else if($this->loginUser()->role == 4){
            $complaints = Complain::where('txtcomplainer_id', Auth::id())->get();
        }else{
            $role = Role::where('id', $this->loginUser()->role)->first();
            $instituteProblem = Problem::where('institutes', $role->institute)->get();
            $problemIds = $instituteProblem->pluck('id');
            $complaints = Complain::where('location', Auth::user()->branch)->whereIn('problem_type', $problemIds)->get();
        }

        // var_dump($role->institute);die();
        return view('complaints.index',['complaints' => $complaints]);
    }

    public function assigedComplaints()
    {

        if (!(Privilege::checkPrivilege(14))) {
            return redirect()->route('dashboard')->with('error', 'You don\'t have Sufficient Permissions to Perform this Operation.');
        }

        $complaints = Assign::join('complaints', 'activities.complaint_id', 'complaints.id')
                    ->where('activities.activity_type', 1)
                    ->where('activities.assigned_to', Auth::id())
                    ->where('complaints.status', 2)
                    ->get([
                        'complaints.*',
                        'activities.created_by as assigned_by',
                    ]);

        return view('complaints.myComplaints',['complaints' => $complaints]);
    }

    public function reAssignedComplaints()
    {

        if (!(Privilege::checkPrivilege(14))) {
            return redirect()->route('dashboard')->with('error', 'You don\'t have Sufficient Permissions to Perform this Operation.');
        }

        $complaints = Assign::join('complaints', 'activities.complaint_id', 'complaints.id')
                    ->where('activities.activity_type', 1)
                    ->where('activities.assigned_to', Auth::id())
                    ->where('complaints.status', 4)
                    ->get([
                        'complaints.*',
                        'activities.created_by as assigned_by',
                    ]);

        return view('complaints.reAssignedComplaints',['complaints' => $complaints]);
    }


    public function createComplain(Request $request)
    {
        $problems = Problem::all();
        $locations = Branch::all();

        return view('complaints.createComplain', ['problems' => $problems, 'locations' => $locations]);
    }

    public function saveComplain(Request $request)
    {
        $this->validate($request, [
            'location' => 'required',
            'problem_type' => 'required',
            'description' => 'required',
            'evidence' => 'required|array|min:1',
            'evidence.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = Complain::create([
            'txtcomplainer_id' => Auth::id(),
            'location' => $request['location'],
            'problem_type' => $request['problem_type'],
            'txtcomplaint_remarks' => $request['description'],
            'status' => 1,
        ]);

        if ($request->hasFile('evidence')) {
            $evidenceFiles = [];
            foreach ($request->file('evidence') as $k => $file) {
                $fileName = $data->id . '.' . $k . '.' . time() . '.' . $file->extension();
                $file->move(public_path('images\attachments'), $fileName);
                $evidenceFiles[] = $fileName;
            }
            Attachment::create([
                'record_id' => $data->id,
                'type' => 1,
                'attachments' => json_encode($evidenceFiles),
            ]);
        }

        return Redirect::to('/complain/list')->with('success', 'Complaint saved Successfully.');
    }

    public function editComplain($id)
    {
        $complaint = Complain::where('id', $id)->first();
        $problems = Problem::all();
        $locations = Branch::all();

        return view('complaints.editComplain',['complaint' => $complaint, 'problems' => $problems, 'locations' => $locations]);
    }

    public function updateComplain(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'location' => 'required',
            'problem_type' => 'required',
            'description' => 'required',
        ]);

        Complain::where('id', $request['id'])
                ->update([
                    'location' => $request['location'],
                    'problem_type' => $request['problem_type'],
                    'txtcomplaint_remarks' => $request['description'],
                ]);

        return Redirect::to('/complain/list')->with('success', 'Complain #'.$request['id'].' Updated Successfully.');

    }

    public function assignUser($id)
    {
        $complaint = Complain::where('id', $id)->first();

        $rolesWithPrivilege = RolePrivilege::whereJsonContains('privileges', '14')->pluck('role_id')->toArray();
        $loginUersRole = Role::where('id', $this->loginUser()->role)->first();
        $users = User::join('roles', 'users.role', 'roles.id')
                    ->whereIn('users.role', $rolesWithPrivilege)
                    ->where('users.branch', $complaint->location)
                    ->where('roles.institute', $loginUersRole->institute)
                    ->get([
                        'users.id as id',
                        'users.name as name'
                    ]);

        return view('complaints.assignUser',['users' => $users, 'complaint' => $complaint]);
    }

    public function saveAssign(Request $request)
    {

        $this->validate($request, [
            'complaint_id' => 'required',
            'assigned_to' => 'required',
            'description' => 'required',
        ]);

        $data = Assign::create([
            'complaint_id' => $request['complaint_id'],
            'activity_type' => 1,
            'description' => $request['description'],
            'created_by' => Auth::id(),
            'assigned_to' => $request['assigned_to'],
        ]);

        Complain::where('id', $request['complaint_id'])
                ->update([
                    'status' => 2,
                ]);

        return Redirect::to('/complain/list')->with('success', 'Assigned saved Successfully.');
    }

    public function completeJob($id)
    {
        $complaint = Complain::where('id', $id)->first();

        return view('complaints.completeJob',['complaint' => $complaint]);
    }

    public function saveComplete(Request $request)
    {

        $this->validate($request, [
            'complaint_id' => 'required',
            'description' => 'required',
            'proof' => 'required|array|min:1',
            'proof.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = Assign::create([
            'complaint_id' => $request['complaint_id'],
            'activity_type' => 2,
            'description' => $request['description'],
            'created_by' => Auth::id(),
            'assigned_to' => null,
        ]);

        Complain::where('id', $request['complaint_id'])
                ->update([
                    'status' => 3,
                ]);

        if ($request->hasFile('proof')) {
            $proofFiles = [];
            foreach ($request->file('proof') as $k => $file) {
                $fileName = $data->id . '.' . $k . '.' . time() . '.' . $file->extension();
                $file->move(public_path('images\proof'), $fileName);
                $proofFiles[] = $fileName;
            }
            Attachment::create([
                'record_id' => $data->id,
                'type' => 2,
                'attachments' => json_encode($proofFiles),
            ]);
        }

        return Redirect::to('/complain/my-complaints')->with('success', 'Complete saved Successfully.');
    }

    public function finishedJob($id)
    {
        $complaint = Complain::where('id', $id)->first();
        return view('complaints.finishedJob',['complaint' => $complaint]);
    }

    public function savefinish(Request $request)
    {

        $this->validate($request, [
            'complaint_id' => 'required',
            'description' => 'required',
        ]);

        $data = Assign::create([
            'complaint_id' => $request['complaint_id'],
            'activity_type' => 3,
            'description' => $request['description'],
            'created_by' => Auth::id(),
            'assigned_to' => null,
        ]);

        Complain::where('id', $request['complaint_id'])
                ->update([
                    'status' => 5,
                ]);

        return Redirect::to('/complain/list')->with('success', 'Assigned saved Successfully.');
    }

    public function reAssignsUser($id)
    {
        $complaint = Complain::where('id', $id)->first();

        $rolesWithPrivilege = RolePrivilege::whereJsonContains('privileges', '14')->pluck('role_id')->toArray();
        $loginUersRole = Role::where('id', $this->loginUser()->role)->first();
        $users = User::join('roles', 'users.role', 'roles.id')
                    ->whereIn('users.role', $rolesWithPrivilege)
                    ->where('users.branch', $complaint->location)
                    ->where('roles.institute', $loginUersRole->institute)
                    ->get([
                        'users.id as id',
                        'users.name as name'
                    ]);

        return view('complaints.reAssignUser',['users' => $users, 'complaint' => $complaint]);
    }

    public function saveReAssign(Request $request)
    {

        $this->validate($request, [
            'complaint_id' => 'required',
            'assigned_to' => 'required',
            'description' => 'required',
        ]);

        $data = Assign::create([
            'complaint_id' => $request['complaint_id'],
            'activity_type' => 4,
            'description' => $request['description'],
            'created_by' => Auth::id(),
            'assigned_to' => $request['assigned_to'],
        ]);

        Complain::where('id', $request['complaint_id'])
                ->update([
                    'status' => 4,
                ]);

        return Redirect::to('/complain/list')->with('success', 'Re-Assigned saved Successfully.');
    }

    public function viewComplain($id)
    {
        $complain = Complain::where('id', $id)->first();
        return view('complaints.viewComplain', ['complain'=>$complain]);
    }

    public function deleteComplain($id)
    {
        Complain::where('id', $id)->delete();
        return Redirect::to('/complain/list')->with('success', 'Complain #'.$id.' Deleted Successfully.');
    }
    public function assign_user($id)
    {
        $complain = Complain::where('id', $id)->first();
        return view('complaints.assign_user', ['complain'=>$complain]);
    }

    public function loginUser()
    {
        return User::find(Auth::id());
    }

}
public function viewComplainProgress($id)
    {
        $complain = Complain::join('users', 'complaints.txtcomplainer_id', 'users.id')
                            ->join('branches', 'complaints.location', 'branches.id')
                            ->join('problem_type', 'complaints.problem_type', 'problem_type.id')
                            ->join('activity_types', 'complaints.status', 'activity_types.id')
                            ->where('complaints.id', $id)
                            ->first([
                                'complaints.*',
                                'users.name as complainer',
                                'problem_type.institutes as institute_id',
                                'problem_type.name as problem_name',
                                'branches.name as location_name',
                            ]);
        return view('complaints.viewProgress', ['complain'=>$complain]);
    }

    public function viewComplainAction($id)
    {
        $activity = Assign::find($id);
        $complain = Complain::join('users', 'complaints.txtcomplainer_id', 'users.id')
                            ->join('branches', 'complaints.location', 'branches.id')
                            ->join('problem_type', 'complaints.problem_type', 'problem_type.id')
                            ->join('activity_types', 'complaints.status', 'activity_types.id')
                            ->where('complaints.id', $activity->complaint_id)
                            ->first([
                                'complaints.*',
                                'users.name as complainer',
                                'problem_type.institutes as institute_id',
                                'problem_type.name as problem_name',
                                'branches.name as location_name',
                            ]);
        return view('complaints.viewActivity', ['complain'=>$complain, 'activity' => $activity]);
    }
