<?php

namespace App\Http\Controllers;
use App\Models\Complain;
use App\Models\User;
use App\Models\Branch;
use App\Models\Role;
use App\Models\Institutes;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class ComplainController extends Controller
{

    public function index()
    { 
        $role = Role::where('id', $this->loginUser()->role)->first();
        $instituteProblem = Problem::where('institutes', $role->institute)->get();
        $problemIds = $instituteProblem->pluck('id');
        // var_dump($problemIds);die();
        $complaints = Complain::whereIn('problem_type', $problemIds)->get();  
        return view('complaints.index',['complaints' => $complaints]);
    }

    //public function createComplain(Request $request)
    //{
       // return view('complaints.createComplain');
    //}
//----------------------
public function createComplain(Request $request)
{
    
    $problems = Problem::all();
    $locations = Branch::all();
    return view('complaints.createComplain', ['problems' => $problems, 'locations' => $locations]);

}
    // Store Form data in database
    public function saveComplain(Request $request)
    {
        
        // Form validation
        $this->validate($request, [
            'location' => 'required',
            'problem_type' => 'required',
            'txtcomplaint_remarks' => 'required',
            'FileDocumentAttachment' => 'required'
        ]);

        $data = Complain::create([
            'txtcomplainer_id' => Auth::id(),
            'location' => $request['location'],
            'problem_type' => $request['problem_type'],
            'txtcomplaint_remarks' => $request['txtcomplaint_remarks'],
            'FileDocumentAttachment' => $request['FileDocumentAttachment'],
            'status' => 1,
        ]);

        return Redirect::to('/complain/list')->with('success', 'Camplaint saved Successfully.');
    }

    public function editComplain($id)
    {
        $complain = Complain::where('id', $id)->first();
        return view('complaints.editComplain',['complain' => $complain]);
    }

    // Update Form data in database
    public function updateComplain(Request $request)
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
       
        Complain::where('id', $request['id'])
                ->update([
                    'txtcomplainer_id' => $request['txtcomplainer_id'],
                    'location' => $request['location'],
                    'problem_type' => $request['problem_type'],
                    'division_id' => $request['division_id'],
                    'txtcomplaint_remarks' => $request['txtcomplaint_remarks'],
                    'FileDocumentAttachment' => $request['FileDocumentAttachment']
                ]);

        return Redirect::to('/complain/list')->with('success', 'Complain #'.$request['id'].' Updated Successfully.');

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
