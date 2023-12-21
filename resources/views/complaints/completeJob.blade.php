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
    <form method="post" action="{{ route('save-complete') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="complaint_id" id="complaint_id" value="{{$complaint->id}}" />

        <div class="row">
            <div class="col-lg-8">
                <h3>
                    <i class="fa fa-solid fa-check"></i>&nbsp;&nbsp;Complete Job
                </h3>
                <hr/>
            </div>
        </div><br/>
                            
        <div class="row">                    
            <div class="col-lg-8">
                <label>
                    Comments
                </label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
        </div><br/>

        <div class="row">
            <div class="col-lg-8">
                <label>
                    Proof
                </label>
                <input type="file" id="proof" name="proof[]" class="form-control @error('proof') is-invalid @enderror" multiple />
                @error('proof')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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


