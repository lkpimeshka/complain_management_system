@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="padding-top: 20px; padding-bottom: 10px;">Edit User</h2>

    <form  method="post" action="{{ route('update-user') }}" novalidate>
        @csrf

        <div class="row">
            <div class="col-sm-12">
    
                <div class="card">
                    <div class="card-body">
    
                        <input type="hidden" name="id" id="id" value="{{$user->id}}">

                        <div class="row">
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <label>Name*</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$user->name}}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <label>Email*</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email" value="{{$user->email}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <label>Role*</label>
                                <select class="form-control" id="role" name="role">
                                    @foreach($userRoles as $userRole)
                                        <?php
                                            if($role == 1){
                                                $institute = App\Models\Institute::where('id', $userRole->institute)->first();
                                                $roleName = $userRole->name.' - '.$institute->name;
                                            }else{
                                                $roleName = $userRole->name;
                                            }
                                        ?>
                                        <option value="{{$userRole->id}}" {{ $userRole->id == $user->role ? 'selected' : '' }}>{{$roleName}}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <label>Telephone*</label>
                                <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{$user->telephone}}">
                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
    
                        <div class="row">
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <label>NIC*</label>
                                <input type="text" class="form-control @error('nic') is-invalid @enderror" name="nic" id="nic" value="{{$user->nic}}">
                                @error('nic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-sm-12" style="margin-bottom: 5px;">
                                <label>Address Line 1*</label>
                                <input type="text" class="form-control @error('address_line_1') is-invalid @enderror" name="address_line_1" id="address_line_1" value="{{$user->address_line_1}}">
                                @error('address_line_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <label>Address Line 2</label>
                                <input type="text" class="form-control @error('address_line_2') is-invalid @enderror" name="address_line_2" id="address_line_2" value="{{$user->address_line_2}}">
                                @error('address_line_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <label>City*</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" value="{{$user->city}}">
                                @error('city')
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
