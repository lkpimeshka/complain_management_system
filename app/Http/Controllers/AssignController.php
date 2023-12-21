<?php

namespace App\Http\Controllers;

use App\Models\Assign;
use App\Models\Complain;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class AssignController extends Controller
{



    public function index()
    { 
        $activities = Assign::get();  
        return view('assigns.index',['activities' => $activities]);
    }


    public function assignUser(Request $request)
    {
        $loginUersRole = Role::where('id', $this->loginUser()->role)->first();
        $users = User::join('roles', 'users.role', 'roles.id')
                    ->where('roles.institute', $loginUersRole->institute)
                    ->get([
                        'users.id as id',
                        'users.name as name'
                    ]);

                    // var_dump($users);die();
        return view('assigns.assignUser',['users' => $users]);
    }

    public function reAssignsJob(Request $request)
    {
        $loginUersRole = Role::where('id', $this->loginUser()->role)->first();
        $users = User::join('roles', 'users.role', 'roles.id')
                    ->where('roles.institute', $loginUersRole->institute)
                    ->get([
                        'users.id as id',
                        'users.name as name'
                    ]);

                    // var_dump($users);die();
        return view('assigns.reAssignUser',['users' => $users]);
    }

    public function finishedJob(Request $request)
    {
        $loginUersRole = Role::where('id', $this->loginUser()->role)->first();
        $users = User::join('roles', 'users.role', 'roles.id')
                    ->where('roles.institute', $loginUersRole->institute)
                    ->get([
                        'users.id as id',
                        'users.name as name'
                    ]);

                    // var_dump($users);die();
        return view('assigns.finishedJob',['users' => $users]);
    }

    // Store Form data in database
    public function saveAssign(Request $request)
    {
        
        // Form validation
        $this->validate($request, [
            'complaint_id' => 'required',
            'activity_type' => 'required',
            'description' => 'required',
            'created_by' => 'required',
            'assigned_to' => 'required',
            //'attachments' => 'required'
        ]);

        $data = assign::create([
            'complaint_id' => $request['complaint_id'],
            'activity_type' => $request['activity_type'],
            'description' => $request['description'],
            'created_by' => Auth::id(),
            'assigned_to' => $request['assigned_to'],
           // 'attachments' => $request['attachments'],

        ]);

        return Redirect::to('/assigns/index')->with('success', 'Assigned saved Successfully.');
    }
 
 
    public function editAssign($id)
    {
        $assign = Assign::where('id', $id)->first();
        return view('assigns.editAssign',['assign' => $assign]);
    }

    // Update Form data in database
    public function updateAssign(Request $request)
    {

        // Form validation
        $this->validate($request, [
            'id' => 'required',
            'txtcomplainer_id' => 'required',
            'location' => 'required',
            'problem_type' => 'required',
            'division_id' => 'required',
            'txtcomplaint_remarks' => 'required',
            'FileDocumentAttachment' => 'required'
        ]);
       
        Assign::where('id', $request['id'])
                ->update([
                    'txtcomplainer_id' => $request['txtcomplainer_id'],
                    'location' => $request['location'],
                    'problem_type' => $request['problem_type'],
                    'division_id' => $request['division_id'],
                    'txtcomplaint_remarks' => $request['txtcomplaint_remarks'],
                    'FileDocumentAttachment' => $request['FileDocumentAttachment']
                ]);

        return Redirect::to('/assign/list')->with('success', 'Assign #'.$request['id'].' updated Successfully.');

    }

    public function viewAssign($id)

    {
        $assign = Assign::where('id', $id)->first();
        return view('assigns.viewAssign', ['assign'=>$assign]);
    }

    public function deleteAssign($id)
    {
        Assign::where('id', $id)->delete();
        return Redirect::to('/assign/list')->with('success', 'Assign #'.$id.' deleted Successfully.');
    }

    public function loginUser()
    {
        return User::find(Auth::id());
    }
    
    public function completeJob(Request $request)
    {
        $loginUersRole = Role::where('id', $this->loginUser()->role)->first();
        $users = User::join('roles', 'users.role', 'roles.id')
                    ->where('roles.institute', $loginUersRole->institute)
                    ->get([
                        'users.id as id',
                        'users.name as name'
                    ]);

                    // var_dump($users);die();
        return view('assigns.completeJob',['users' => $users]);
    }



    // Store Form data in database
    public function saveComplete_Job(Request $request)
    {
        
        // Form validation
        $this->validate($request, [
            'complaint_id' => 'required',
            'activity_type' => 'required',
            'description' => 'required',
            // 'created_by' => 'required',
            'assigned_to' => 'required',
            // 'attachments' => 'required'
            'attachments.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = Assign::create([
            'complaint_id' => $request['complaint_id'],
            'activity_type' => $request['activity_type'],
            'description' => $request['description'],
            'created_by' => Auth::id(),
            'assigned_to' => $request['assigned_to'],
            // 'attachments' => $request['attachments'],

        ]);

        foreach ($request->file('attachments') as $attachment) {
            $atchImage = $request['complaint_id'] . '.' . time() . '.' . $attachment->extension();
            $attachment->move(public_path('images\users\attachments'), $atchImage);
            Attachment::create([
                'record_id' => $data->id,
                'user_type' => 2,
                'attachments' => $atchImage,
            ]);
        }

        return Redirect::to('/assigns/index')->with('success', 'Job completed Successfully.');
    }
}
