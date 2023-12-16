@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row" style="padding-top: 20px; padding-bottom: 30px;">
        <div class="col-sm-12">
            <h2>Article #{{$article->id}} | View</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table" style="width: 100%">
                <tbody>
                    <tr><th style="width: 35%">ID</th><td>{{$article->id}}</td></tr>
                    <tr><th style="width: 35%">Title</th><td>{{$article->title}}</td></tr>
                    <tr><th style="width: 35%">Description</th><td>{{$article->description}}</td></tr>
                    <tr><th style="width: 35%">Created Date</th><td>{{$article->created_at}}</td></tr>
                    <tr><th style="width: 35%">Updated Date</th><td>{{$article->updated_at}}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


