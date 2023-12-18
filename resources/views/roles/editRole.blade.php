@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="padding-top: 20px; padding-bottom: 10px;">Edit Role</h2>

    <form  method="post" action="{{ route('update-role') }}" novalidate>
        @csrf

    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-body">

                    <h4 style="margin-top: 20px;">Role Info</h4>
                    <hr/>

                    <input type="hidden" name="id" id="id" value="{{$roleModel->id}}">

                    <div class="row">
                        <div class="col-sm-12">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$roleModel->name}}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <label>Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{$roleModel->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <h4 style="margin-top: 20px;">Account Privileges</h4>
                    <hr/>

                    <div class="row">
                        {{-- {{var_dump($currentPrivilegeIds)}} --}}
                        @foreach($userPrivileges as $privilege)
                            <div class="col-sm-6 col-md-4 col-lg-3" style="margin-bottom: 5px;">
                                <label>
                                    <input type="checkbox" name="privileges[]" value="{{ $privilege->id }}" 
                                        @if($currentPrivilegeIds)
                                            {{ in_array($privilege->id, $currentPrivilegeIds) ? 'checked' : '' }}
                                        @endif
                                    >
                                    {{ $privilege->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <input type="submit" name="send" value="Submit" class="btn btn-info btn-block" style="margin-bottom: 20px; margin-top: 20px;">

                </div>
            </div>
        </div>
    </div>

    </form>
</div>
@endsection
