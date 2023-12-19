@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row" style="padding-top: 20px; padding-bottom: 30px;">
        <div class="col-sm-12">
            <h2>My Account</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table" style="width: 100%">
                <tbody>
                    <tr><th style="width: 35%">ID</th><td>{{$user->id}}</td></tr>
                    <tr><th style="width: 35%">Name</th><td>{{$user->name}}</td></tr>
                    <tr><th style="width: 35%">Role</th><td>{{$user->role_name}}</td></tr>
                    <tr><th style="width: 35%">Institutes</th><td>{{$user->institutes_name}}</td></tr>
                    <tr><th style="width: 35%">Email</th><td>{{$user->email}}</td></tr>
                    <tr><th style="width: 35%">Telephone</th><td>{{$user->telephone}}</td></tr>
                    <tr><th style="width: 35%">NIC</th><td>{{$user->nic}}</td></tr>
                    <tr><th style="width: 35%">Address Line 1</th><td>{{$user->address_line_1}}</td></tr>
                    <tr><th style="width: 35%">Address Line 2</th><td>{{$user->address_line_2}}</td></tr>
                    <tr><th style="width: 35%">City</th><td>{{$user->city}}</td></tr>
                    <tr><th style="width: 35%">Created Date</th><td>{{$user->created_at}}</td></tr>
                    <tr><th style="width: 35%">Updated Date</th><td>{{$user->updated_at}}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


