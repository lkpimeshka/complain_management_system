<?php 
use App\Models\Assign; 
use App\Models\RolePrivilege; 

$lgUser = Illuminate\Support\Facades\Auth::user();

$rolesWithPrivilege = RolePrivilege::where('role_id', $lgUser->role)->pluck('privileges');
$privilegeList = count($rolesWithPrivilege) > 0 ? json_decode($rolesWithPrivilege[0], true) : null;

?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 style="padding-top: 20px; padding-bottom: 10px;">Complaints</h2>
        </div>

        @if(Auth::user()->role == 4)
            <div class="col-md-6">
                <a href="{{url('complain/create')}}" class="btn btn-md btn-success" style="margin-top: 20px; float: right">New Complaint</a>
            </div>
        @endif
    </div>
    <hr/>

    <table id="datatable" class="display nowrap datatable" style="width:100%; padding-top: 20px;">
        <thead>
            <tr>
                <th>Complait ID</th>
                <th>Complainer</th>
                <th>Branch</th>
                <th>Problem Type</th>
                <th>Description</th>
                <th>Status</th>
                <th>Complaint Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if($complaints)
                @foreach ($complaints as $k => $complaint)
                    <?php

                        $statusModel = App\Models\Status::where('id', $complaint->status)->first();
                        if($complaint->status != 1){
                            if($complaint->status == 2){
                                $activityRecord = Assign::where('complaint_id', $complaint->id)->where('activity_type', 1)->first();
                            }
                        }
                        $complaner = App\Models\User::where('id',$complaint->txtcomplainer_id)->first();
                        $problem = App\Models\Problem::where('id',$complaint->problem_type)->first();
                        $branch = App\Models\Branch::where('id',$complaint->location)->first();

                    ?>

                    <tr>
                        <td>{{$complaint->id}}</td>
                        <td>{{$complaner->name}}</td>
                        <td>{{$branch->name}}</td>
                        <td>{{$problem->name}}</td>
                        <td>{{$complaint->txtcomplaint_remarks}}</td>
                        <td style="background-color: <?php echo $statusModel->name === 'Pending' ? 'orange' : ($statusModel->name === 'InProgress' ? 'green' : ($statusModel->name === 'Complete' ? 'blue' : ($statusModel->name === 'Finished' ? 'purple' : 'red'))); ?>; padding: 5px 10px;"><?php echo $statusModel->name; ?></td>
                        <td>{{$complaint->created_at}}</td>
                        <td>
                            @if($lgUser->role != 1 && $lgUser->role != 4)
                                @if($complaint->status == 1)
                                    @if ($privilegeList && in_array(13, $privilegeList))
                                        <a href="{{ url('complain/assign/'.$complaint->id)}}" class="btn btn-success btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Assign To</a>
                                    @endif
                                @elseif($complaint->status == 3)
                                    @if ($privilegeList && in_array(15, $privilegeList))
                                        <a href="{{ url('complain/finishedJob/'.$complaint->id)}}" class="btn btn-warning btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Finished</a>
                                    @endif
                                    @if ($privilegeList && in_array(13, $privilegeList))
                                        <a href="{{ url('complain/reAssignUser/'.$complaint->id)}}" class="btn btn-danger btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Re-Assign</a>
                                    @endif
                                @endif
                            @endif
                            <a href="{{url('complain/view/'.$complaint->id)}}" class="btn btn-secondary btn-sm" title ="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            @if($lgUser->role != 1 && $complaint->status == 1)
                                @if($lgUser->role == 4)
                                    <a href="{{url('complain/edit/'.$complaint->id)}}" class="btn btn-primary btn-sm" title ="Edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
