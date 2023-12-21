<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
?>


@extends('layouts.app')

@section('content')
<div class="container">

    <form method="post" action="{{ route('store-complain') }}" enctype="multipart/form-data">
        @csrf
        <div id="wrapper">
            <div id="page-wrapper">
                <div class="col-md-12 graphs">
                    <div class="xs"><br><br>
                        <h3>
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;New Complaint
                        </h3>
                        <hr/><br/>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label>
                                        Problem Type
                                    </label>
                                    <select id="problem_type" name="problem_type" class="form-control">
                                        @foreach($problems as $prolem)
                                            <option value="{{$prolem->id}}">{{$prolem->name}}</option>
                                        @endforeach
                                    </select>  
                                </div>
                                   
                                <div class="col-lg-6">
                                    <label>
                                        Location
                                    </label>
                                    <select id="location" name="location" class="form-control">
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                            <br/>
                         
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>
                                        Description
                                    </label>
                                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><br/>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label>
                                        Evidence
                                    </label>
                                    <input type="file" id="evidence" name="evidence[]" class="form-control @error('evidence') is-invalid @enderror" multiple />
                                    @error('evidence')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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


