@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="padding-top: 20px; padding-bottom: 10px;">Create Role</h2>

    <form  method="post" action="{{ route('store-role') }}" novalidate>
        @csrf

    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12" style="margin-bottom: 5px;">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @if($role == 1)
                            <div class="col-sm-12" style="margin-bottom: 5px;">
                                <label>Institute</label>
                                <select class="form-control @error('institute') is-invalid @enderror" id="institute" name="institute">
                                    @foreach($institutes as $institute)
                                        <option value="{{$institute->id}}">{{$institute->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="col-sm-12" style="margin-bottom: 5px;">
                            <label>Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input type="submit" name="send" value="Submit" class="btn btn-info btn-block" style="margin-bottom: 20px; margin-top: 20px;">

                </div>
            </div>
        </div>
    </div>

    </form>
</div>
@endsection
