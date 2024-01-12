<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\Role;
use App\Models\User;
use App\Models\Problem;
use App\Models\RolePrivilege; 
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role == 1){
            $complaints = Complain::orderBy('id', 'desc')->limit(5)->get();
            $totalComplaints = Complain::get();
            $pendingComplaints = Complain::where('status', 1)->get();
            $completedComplaints = Complain::where('status', 5)->get();
            $users = User::where('role', 4)->get();

        } else if(Auth::user()->role == 4){
            $complaints = Complain::where('txtcomplainer_id', Auth::id())->limit(5)->get();
            $totalComplaints = Complain::where('txtcomplainer_id', Auth::id())->get();
            $pendingComplaints = Complain::where('txtcomplainer_id', Auth::id())->where('status', 1)->get();
            $completedComplaints = Complain::where('txtcomplainer_id', Auth::id())->where('status', 5)->get();
            $users = null;
        }else{
            if(Auth::user()->role == 2 || Auth::user()->role == 3){
                $role = Role::where('id', Auth::user()->role)->first();
                $instituteProblem = Problem::where('institutes', $role->institute)->get();
                $problemIds = $instituteProblem->pluck('id');
                $complaints = Complain::whereIn('problem_type', $problemIds)->limit(5)->get();  
                $totalComplaints = Complain::whereIn('problem_type', $problemIds)->get();
                $pendingComplaints = Complain::where('status', 1)->whereIn('problem_type', $problemIds)->get();
                $completedComplaints = Complain::where('status', 5)->whereIn('problem_type', $problemIds)->get();
                $users = User::where('role', 4)->get();
            }else{
                $role = Role::where('id', Auth::user()->role)->first();
                $instituteProblem = Problem::where('institutes', $role->institute)->get();
                $problemIds = $instituteProblem->pluck('id');
                $complaints = Complain::whereIn('problem_type', $problemIds)->where('location', Auth::user()->branch)->limit(5)->get();  
                $totalComplaints = Complain::whereIn('problem_type', $problemIds)->where('location', Auth::user()->branch)->get();
                $pendingComplaints = Complain::where('status', 1)->whereIn('problem_type', $problemIds)->where('location', Auth::user()->branch)->get();
                $completedComplaints = Complain::where('status', 5)->whereIn('problem_type', $problemIds)->where('location', Auth::user()->branch)->get();
                $users = User::where('role', 4)->where('branch', Auth::user()->branch)->get();
            }    
        }
        // var_dump($complaints);die();
        return view('dashboard.dashboard',['users' => $users, 'complaints' => $complaints, 'totalComplaints' => $totalComplaints, 'pendingComplaints' => $pendingComplaints, 'completedComplaints' => $completedComplaints]);
        // return view('dashboard');
    }

    
}
