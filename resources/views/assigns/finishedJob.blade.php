<?php

use App\Models\User;
use App\Models\Complain;
use App\Models\Assign;
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
    <form id="form1" method="post" action="{{ route('store-assign') }}" runat="server" onsubmit="return ValidationInputData()">
        @csrf
        <div id="wrapper">
            <!-- Navigation -->
            <input type="hidden" name="HiddenField_MODE" id="HiddenField_MODE" runat="server" />
            <input type="hidden" name="HiddenField_idtbl_lead" id="HiddenField_idtbl_lead" runat="server" />
            <div id="page-wrapper">
                <div class="col-md-12 graphs">
                    <div class="xs"><br><br>
                        <h3>
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Finalize Job.
                        </h3>
                        <div class="well1 white" style="min-height: 700px;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" id="complaint_id" name="complaint_id" value="10" class="form-control">
                                    <p class="help-block">
                                    </p>
                                </div>
                            </div>
                                    <div class="col-lg-6">
                                    
                                    <input type="hidden" id="activity_type" name="activity_type" value="5" class="form-control">
                                    <p class="help-block">
                                    </p>
                                </div>
                                <div>
                                        <input type="hidden" id="assigned_to" name="assigned_to" value="{{$id}}" class="form-control"> 
                                        <!--<option value="Duration too high">No feedback for inquiries</option>-->
                               </div> 
                            <div class="row">
                                <div class="col-lg-8">
                                    <label>
                                    Comments
                                    </label>
                                    <textarea id="description" name="description" class="form-control"></textarea>
                                    <p class="help-block">
                                    </p>
                                </div>
                            <input type="hidden" id="txtcomplainer_id" name="txtcomplainer_id" value="{{$id}}" class="form-control">
                         
                                    <input type="hidden" id="created_by" name="created_by" value="{{$id}}" placeholder="{{ $username ? $username : '' }}" class="form-control">
                                    <p class="help-block">
                                    </p>
                                </div>

                            <!-- <div class="row">
                                <div class="col-lg-12">
                                    <label>
                                        Attachments
                                    </label>
                                    <input type="file" id="attachments" name="attachments" class="form-control" onchange="clearFile('attachments')" />
                                    <p class="help-block">
                                    </p>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col-lg-8">
                                    <input type="submit" name="send" value="Finish Task" class="btn btn-info btn-block" style="margin-bottom: 20px; margin-top: 20px;">
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


