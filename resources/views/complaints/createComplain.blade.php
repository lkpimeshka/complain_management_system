<?php

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
    <div class="se-pre-con"></div>
    <form id="form1" method="post" action="{{ route('store-complain') }}" runat="server" onsubmit="return ValidationInputData()">
        @csrf
        <div id="wrapper">
            <!-- Navigation -->
            <input type="hidden" name="HiddenField_MODE" id="HiddenField_MODE" runat="server" />
            <input type="hidden" name="HiddenField_idtbl_lead" id="HiddenField_idtbl_lead" runat="server" />
            <div id="page-wrapper">
                <div class="col-md-12 graphs">
                    <div class="xs"><br><br>
                        <h3>
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;New Complaint
                        </h3>
                        <div class="well1 white" style="min-height: 700px;">

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>
                                        Problem Type
                                    </label>
                                    <select id="problem_type" name="problem_type" class="form-control chosen-select" onchange="__doPostBack('problem_type','')">
                                        @foreach($problems as $prolem)
                                            <option value="{{$prolem->id}}">{{$prolem->name}}</option>
                                        @endforeach
                                        
                                        <!--<option value="Duration too high">No feedback for inquiries</option>-->
                                    </select>  
                                </div>
                                   
                                <div class="col-lg-6">
                                    <label>
                                        Location
                                    </label>
                                    <select id="location" name="location" class="form-control chosen-select" onchange="__doPostBack('location','')">
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach 
            
                                    </select>
                                    <p class="help-block">
                                    </p>
                                </div>
                            </div>
                            <br/>
                         
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>
                                        Description
                                    </label>
                                    <textarea id="txtcomplaint_remarks" name="txtcomplaint_remarks" class="form-control"></textarea>
                                    <p class="help-block">
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label>
                                        Attachments
                                    </label>
                                    <input type="file" id="FileDocumentAttachment" name="FileDocumentAttachment" class="form-control" onchange="clearFile('FileDocumentAttachment')" />
                                    <p class="help-block">
                                    </p>
                                </div>
                            </div>
     
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="submit" name="send" value="Submit" class="btn btn-info btn-block" style="margin-bottom: 20px; margin-top: 20px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


