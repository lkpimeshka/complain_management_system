@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row" style="padding-top: 20px; padding-bottom: 30px;">
        <div class="col-sm-12">
            <h2>Complaint- #{{$complain->id}} Details</h2>
        </div>
    </div>
 
    <div class="row">
        <div class="col-sm-12">
            <table class="table" style="width: 100%">
                <tbody>
                    <tr><th style="width: 35%">ID</th><td>{{$complain->id}}</td></tr>
                    <tr><th style="width: 35%">User ID</th><td>{{$complain->txtcomplainer_id}}</td></tr>
                    <tr><th style="width: 35%">Location</th><td>{{$complain->location}}</td></tr>
                    <tr><th style="width: 35%">Problem Type</th><td>{{$complain->problem_type}}</td></tr>
                    <tr><th style="width: 35%">Description</th><td>{{$complain->txtcomplaint_remarks}}</td></tr>
                    <tr><th style="width: 35%">Attachments</th><td>{{$complain->FileDocumentAttachment}}</td></tr>
                    <tr><th style="width: 35%">Updated Date</th><td>{{$complain->updated_at}}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="col-lg-12">
    <a href="{{ url('complain/assign_user/'.$complain->id) }}" class="btn btn-primary btn-lg" style="margin-bottom: 20px; margin-top: 20px width:80px;">Assign To</a>
</div>

</div>
@endsection


