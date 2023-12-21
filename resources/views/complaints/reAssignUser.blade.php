<?php

use App\Models\User;
use App\Models\Complain;
use App\Models\Assign;
use Illuminate\Support\Facades\Auth;

?>

@extends('layouts.app')

@section('content')
<div class="container">
    <br><br>
    <form method="post" action="{{ route('save-re-assign') }}" >
        @csrf

        <input type="hidden" name="complaint_id" id="complaint_id" value="{{$complaint->id}}" />

        <div class="row">
            <div class="col-lg-8">
                <h3>
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Re-Assign User
                </h3>
                <hr/>
            </div>
        </div><br/>

        <div class="row">
            <div class="col-lg-8">
                <label>
                    Assign To
                </label>
                <select id="assigned_to" name="assigned_to" class="form-control chosen-select" onchange="__doPostBack('assigned_to','')">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div><br/>
                            
        <div class="row">                    
            <div class="col-lg-8">
                <label>
                    Comments
                </label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <input type="submit" name="send" value="Submit" class="btn btn-info btn-block" style="margin-bottom: 20px; margin-top: 20px;">
            </div>
        </div>

    </form>
</div>
@endsection


