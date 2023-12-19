<?php

use App\Models\Assign;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

$currentUser = User::find(Auth::id());
//$username=$_REQUEST['name'];
if ($currentUser) {
    $username = $currentUser->name;
    $email = $currentUser->email;
    $id = $currentUser->id;
    

     // Assuming the username column is 'name'
    // Do something with $username
} else {
    // User not found
}
?>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 style="padding-top: 20px; padding-bottom: 10px;">Assinged Jobs</h2>
        </div>

        
    </div>
    <hr/>

    <table id="datatable" class="display nowrap" style="width:100%; padding-top: 20px;">
        <thead>
            <tr>
                <th>Complait ID</th>
                <th>Complainer ID</th>
                <th>Location</th>
                <th>Problem Type</th>
                <th>Description</th>
                <th>Attachments</th>
                <th>Complaint Date</th>
                <th>Last update Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if($activities)
                @foreach ($activities as $k => $activities)
                    <tr>
                        <td>{{$activities->id}}</td>
                        <td>{{$activities->complaint_id}}</td>
                        <td>{{$activities->activity_type}}</td>
                        <td>{{$activities->description}}</td>
                        <td>{{$activities->assigned_to}}</td>
                        <td>{{$activities->attachments}}</td>
                        <td>{{$activities->created_at}}</td>
                        <td>{{$activities->updated_at}}</td>
                        <td>
                            <a href="{{ url('assigns/assignUser/'.$activities->id)}}" class="btn btn-success btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Complete Job</a>
                            <a href="{{ url('assigns/assignUser/'.$activities->id)}}" class="btn btn-success btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Submit Details</a>
                            <a href="{{url('complain/view/'.$activities->id)}}" class="btn btn-success btn-sm" title ="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('complain/edit/'.$activities->id)}}" class="btn btn-primary btn-sm" title ="Edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                            <a href="{{url('complain/delete/'.$activities->id)}}" class="btn btn-danger btn-sm" title ="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
        <tr>
                <th> ID</th>
                <th>Complaint ID</th>
                <th>Activity type</th>
                <th>Problem Type</th>
                <th>Description</th>
                <th>Attachments</th>
                <th>Complaint Date</th>
                <th>Last update Date</th>
                
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@section('script')
    @if(Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
@endsection