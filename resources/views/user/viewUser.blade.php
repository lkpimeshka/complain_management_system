@extends('layouts.app')

@section('content')
<div class="container">

    <br/>
    <div class="card" style="padding: 1rem;">

        <div class="row" style="padding-top: 20px; padding-bottom: 30px;">
            <div class="col-sm-12">
                <h2>User #{{$user->id}} | View</h2>
                <hr/>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12" style="margin-left: 10px">
                <div class="row">
                    <div class="col-sm-4">
                        <label>ID</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->id}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Name</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Role</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->role_name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Institutes</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->institutes_name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Email</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->email}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Telephone</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->telephone}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>NIC</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->nic}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Address Line 1</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->address_line_1}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Address Line 2</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->address_line_2}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>City</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->city}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Created Date</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->created_at}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Updated Date</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$user->updated_at}}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


