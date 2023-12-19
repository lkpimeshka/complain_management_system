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
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Assign user
                        </h3>
                        <div class="well1 white" style="min-height: 700px;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" id="txtcomplainer_id" name="txtcomplainer_id" value="{{$id}}" class="form-control">
                                    <p class="help-block">
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-lg-6">
                                    <label>
                                        Problem Type
                                    </label>
                                    <select id="problem_type" name="problem_type" class="form-control chosen-select" onchange="updateDivision()">
                                        <option value="Complaint-1">Complaint-1</option>
                                        <option value="Complaint-2">Complaint-2</option>
                                        <option value="Complaint-3">Complaint-3</option>
                                       
                                    </select>
                                    <script>
        function updateDivision() {
            var select = document.getElementById("problem_type");
            var selectedValue = select.options[select.selectedIndex].value;
            var division_id = document.getElementById("division_id"); // Corrected ID

            // Update the division based on the selected option
            if (selectedValue === "Complaint-1") {
                division_id.value = "2";
            } else if (selectedValue === "Complaint-2") {
                division_id.value = "1";
            } else if (selectedValue === "Complaint-3") {
                division_id.value = "2";
            }
        }
    </script>
           
                       
                                    <div class="col-lg-6">
                                    <input type="hidden" id="division_id" name="division_id" value="" class="form-control">

                                    <p class="help-block">
                                    </p>
                                </div>
                                    <p class="help-block">
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <label>
                                        Location
                                    </label>
                                    <select id="location" name="location" class="form-control chosen-select" onchange="__doPostBack('location','')">
                                        <option value="Colombo">Colombo</option>
                                        <option value="Gampaha">Gampaha</option>
                                        <option value="Kaluthara">Kaluthara</option>
                                        <option value="Kegalle">Kagella</option>
                                        <!--<option value="Duration too high">No feedback for inquiries</option>-->
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
                            <br />
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
                            <br />
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


