@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="padding-top: 20px; padding-bottom: 10px;">Edit Complain</h2>

    <form  method="post" action="{{ route('update-complain') }}" novalidate>
        @csrf

    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-body">

                    <input type="hidden" name="id" id="id" value="{{$complaint->id}}">

                    <div class="row">
                        <div class="col-lg-6">
                            <label>
                                Problem Type
                            </label>
                            <select id="problem_type" name="problem_type" class="form-control">
                                @foreach($problems as $prolem)
                                    <option value="{{$prolem->id}}" {{ $complaint->problem_type == $prolem->id ? 'selected' : '' }}>{{$prolem->name}}</option>
                                @endforeach
                            </select>  
                        </div>
                           
                        <div class="col-lg-6">
                            <label>
                                Location
                            </label>
                            <select id="location" name="location" class="form-control">
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}" {{ $complaint->location == $location->id ? 'selected' : '' }}>{{$location->name}}</option>
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
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{$complaint->txtcomplaint_remarks}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div><br/>

                    <input type="submit" name="send" value="Submit" class="btn btn-info btn-block" style="margin-bottom: 20px; margin-top: 20px;">

                </div>
            </div>
        </div>
    </div>

    </form>
</div>
@endsection
