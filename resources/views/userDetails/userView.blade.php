<?php
use Illuminate\Support\Facades\Auth;

$currentUser = Auth::id();
$currentUserModal = App\Models\User::find(Auth::id());
?>
@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row" style="padding-top: 20px; padding-bottom: 30px;">
        <div class="col-sm-12">
            <h2>User #{{ $user['id'] }} | Profile</h2>
        </div>
    </div>
    {{-- <hr style="margin-top: 0px"> --}}

    @if(Session::has('success'))
        <div class="alert alert-dismissable alert-success text-center">
            {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span style="color: white" aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::has('danger'))
        <div class="alert alert-dismissable alert-danger text-center">
            {{Session::get('danger')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span style="color: white" aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body" style="text-align: center; margin-bottom: 20px;">
                    <?php $avatarPic = ($userDetails['image'])? $userDetails['image'] :  'default-profile.jpg'; ?>
                    <img src="{{ asset('images/profile_pic/'.$avatarPic) }}" class="img img-responsive image-previewer" style="border-radius: 50%; margin: 10px; width: 70%; height: auto;"  alt="Profile Picture" title="Profile Picture">
                    @if (($currentUser == 1 && $user['id'] == 1)|| $currentUser != 1)
                    <div class="avatar-upload btn btn-sm btn-link">
                        <label for="user_avatar"><i class="fa fa-pencil-alt" aria-hidden="true"></i>&nbsp; Edit Picture</label>
                        <input type="file" name="user_avatar" id="user_avatar">
                    </div>
                    @endif

                    <p>
                        {{ $user['name'] }} <br/>
                        <span style="font-size: 14px;">{{ $user['email'] }}</span>
                    </p>

                    @if (($currentUser == 1 && $user['id'] == 1)|| $currentUser != 1)
                        <a href="{{ URL::to('packages') }}" class="btn btn-info btn-sm" style="margin: 1px;"  title ="Package List"><i class="fa fa-archive" aria-hidden="true"></i> Packages</a>
                        <a class="btn btn-info btn-sm" href="{{ route('logout') }}" style="margin: 1px;"  title ="Log Out"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off" aria-hidden="true"></i> Log out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                    <span style="font-size: 14px; color: white; padding: 5px; background-color: {{ ($user['status'] == 0)? '#dc3545' : '#28a745'}};">
                        {{ ($user['status'] == 0)? 'Unverified Account' : 'Verified Account'}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card">
            <div class="card-body">

            <div class="row">
                <div class="col-sm-12">
                    @if ($currentUserModal->role == 1)
                        <a href="{{ URL::to('user/changeAccountStatus/'.$user['id']) }}" class="btn btn-sm {{ ($user['status'] == 0)? 'btn-success' : 'btn-danger'}}" style="float: right; font-weight: 900;" title ="New Bill">
                            {{ ($user['status'] == 0)? 'set Verified' : 'set UnVerified'}}
                        </a>
                    @endif
                </div>
            </div>

            <form  method="post" action="{{ route('update-user') }}" novalidate>
                @csrf

            <input type="hidden" class="form-control" name="id" id="id" value="{{ $user['id'] }}">

            <div class="form-group wrap-input100">
                <label class="label-input100">Name</label>
                <input type="text" class="form-control input-no-border @error('name') is-invalid @enderror" name="name" id="name" value="{{ $user['name'] }}">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group wrap-input100">
                <label class="label-input100">Email</label>
                <input type="text" class="form-control input-no-border @error('email') is-invalid @enderror" style="background-color: transparent !important" name="email" id="email" value="{{ $user['email'] }}" readonly>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group wrap-input100">
                <label class="label-input100">Address Line 1</label>
                <input type="text" class="form-control input-no-border @error('address_line_1') is-invalid @enderror" name="address_line_1" id="address_line_1" value="{{ $userDetails['address_line_1'] }}">

                @error('address_line_1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group wrap-input100">
                <label class="label-input100">Address Line 2</label>
                <input type="text" class="form-control input-no-border @error('address_line_2') is-invalid @enderror" name="address_line_2" id="address_line_2" value="{{ $userDetails['address_line_2'] }}">

                @error('address_line_2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group wrap-input100">
                <label class="label-input100">City</label>
                <input type="text" class="form-control input-no-border @error('city') is-invalid @enderror" name="city" id="city" value="{{ $userDetails['city'] }}">

                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group wrap-input100">
                <label class="label-input100">Telephone</label>
                <input type="text" class="form-control input-no-border @error('telephone') is-invalid @enderror" name="telephone" id="telephone" value="{{ $userDetails['telephone'] }}">

                @error('telephone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group wrap-input100">
                <label class="label-input100">Company</label>
                <input type="text" class="form-control input-no-border @error('company') is-invalid @enderror" name="company" id="company" value="{{ $userDetails['company'] }}">

                @error('company')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <input type="submit"  value="Save Changes" class="btn btn-info btn-block" style="margin-bottom: 20px;">
            </form>
        </div>
        </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#user_avatar').ijaboCropTool({
       preview : '.image-previewer',
       setRatio:1,
       allowedExtensions: ['jpg', 'jpeg','png'],
       buttonsText:['CROP & SAVE','QUIT'],
       buttonsColor:['#30bf7d','#ee5155', -15],
       processUrl:'{{ route("crop") }}',
       withCSRF:['_token','{{ csrf_token() }}'],
       onSuccess:function(message, element, status){
          //alert(message);
       },
       onError:function(message, element, status){
         alert(message);
       }
    });

    $(function() {
        var timeout = 5000; // in miliseconds (5*1000)
        $('.alert').delay(timeout).fadeOut(300);
    });
</script>
@endsection
