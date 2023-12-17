@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row" style="padding-top: 20px; padding-bottom: 30px;">
        <div class="col-sm-12">
            <h2>Complaint- #{{$article->id}} Details</h2>
        </div>
    </div>
    updated_at
    <div class="row">
        <div class="col-sm-12">
            <table class="table" style="width: 100%">
                <tbody>
                    <tr><th style="width: 35%">ID</th><td>{{$article->id}}</td></tr>
                    <tr><th style="width: 35%">User ID</th><td>{{$article->txtcomplainer_id}}</td></tr>
                    <tr><th style="width: 35%">Location</th><td>{{$article->location}}</td></tr>
                    <tr><th style="width: 35%">Problem Type</th><td>{{$article->problem_type}}</td></tr>
                    <tr><th style="width: 35%">Description</th><td>{{$article->txtcomplaint_remarks}}</td></tr>
                    <tr><th style="width: 35%">Attachments</th><td>{{$article->FileDocumentAttachment}}</td></tr>
                    <tr><th style="width: 35%">Updated Date</th><td>{{$article->updated_at}}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


