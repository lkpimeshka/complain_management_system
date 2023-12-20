<?php use App\Models\Assign; ?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 style="padding-top: 20px; padding-bottom: 10px;">Complaints</h2>
        </div>

        <div class="col-md-6">
            <a href="{{url('complain/create')}}" class="btn btn-md btn-success" style="margin-top: 20px; float: right">New Complaint</a>
        </div>
    </div>
    <hr/>

    <table id="datatable" class="display nowrap datatable" style="width:100%; padding-top: 20px;">
        <thead>
            <tr>
                <th>Complait ID</th>
                <th>Complainer</th>
                <th>Location</th>
                <th>Problem Type</th>
                <th>Description</th>
                <th>Status</th>
                <th>Complaint Date</th>
                <th>Last update Date</th>
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

                    ?>

                    <tr>
                    <td>{{$complaint->id}}</td>
                        <td>{{$complaner->name}}</td>
                        <td>{{$complaint->location}}</td>
                        <td>{{$problem->name}}</td>
                        <td>{{$complaint->txtcomplaint_remarks}}</td>
                        <td style="background-color: <?php echo $statusModel->name === 'Pending' ? 'orange' : ($statusModel->name === 'InProgress' ? 'green' : ($statusModel->name === 'Complete' ? 'blue' : ($statusModel->name === 'Finished' ? 'purple' : 'red'))); ?>; padding: 5px 10px;"><?php echo $statusModel->name; ?></td>


                        <td>{{$complaint->created_at}}</td>
                        <td>{{$complaint->updated_at}}</td>
                        <td>
                            @if($complaint->status == 1)
                                <a href="{{ url('assigns/assignUser/'.$complaint->id)}}" class="btn btn-success btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Assign To</a>
                            @elseif($complaint->status == 2)
                                <a href="{{ url('assigns/completeJob/'.$activityRecord->id)}}" class="btn btn-primary btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Complete Job</a>
                            @elseif($complaint->status == 3)
                                <a href="{{ url('assigns/finishedJob/'.$activityRecord->id)}}" class="btn btn-warning btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Finished</a>
                                <a href="{{ url('assigns/reAssignUser/'.$activityRecord->id)}}" class="btn btn-danger btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Re-Assign</a>
                            <!--@elseif($complaint->status == 4)
                                <a href="{{ url('assigns/assignUser/'.$activityRecord->id)}}" class="btn btn-warning btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Re-Assign To</a>-->
                            @endif
                            <a href="{{url('complain/view/'.$complaint->id)}}" class="btn btn-secondary btn-sm" title ="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('complain/edit/'.$complaint->id)}}" class="btn btn-primary btn-sm" title ="Edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
