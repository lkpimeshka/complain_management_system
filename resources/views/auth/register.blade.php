@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="address_line_1">{{ __('Address Line 1') }}</label>
                                <input id="address_line_1" type="text" class="form-control @error('address_line_1') is-invalid @enderror" name="address_line_1" value="{{ old('address_line_1') }}" autofocus>

                                @error('address_line_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="address_line_2">{{ __('Address Line 2') }}</label>
                                <input id="address_line_2" type="text" class="form-control @error('address_line_2') is-invalid @enderror" name="address_line_2" value="{{ old('address_line_2') }}" autofocus>

                                @error('address_line_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="address">{{ __('City') }}</label>
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="zip">{{ __('Zip/Postal code') }}</label>
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" autofocus>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="telephone">{{ __('Telephone') }}</label>
                                <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" autofocus>

                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="nic_pp_no">{{ __('NIC / Passport No') }}</label>
                                <input id="nic_pp_no" type="text" class="form-control @error('nic_pp_no') is-invalid @enderror" name="nic_pp_no" value="{{ old('nic_pp_no') }}" autofocus>

                                @error('nic_pp_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The NIC / Passport field is required.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="float: right">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">

    $('#company_or_individual').on('change', function() {
        var val = document.getElementById("company_or_individual").value;
        if(val == 1){
            $('#company_name_block').hide();
            document.getElementById("company").value = null;
            $('#br_block').hide();
            document.getElementById("br_copy").value = null;
            $('#br_copy_preview').attr('src', '/images/users/default_registration_form_image.jpg');

        }else{
            $('#company_name_block').show();
            $('#br_block').show();
        }
    });

    $(document).ready(function (e) {

        $('#nic_or_passport_front_image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#nic_pp_front_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#nic_or_passport_back_image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#nic_pp_back_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#billing_proof').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#billing_proof_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#br_copy').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#br_copy_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

    $(document).ready(function(){
        if(document.getElementById("company_or_individual").value == 1){
            $('#company_name_block').hide();
            $('#br_block').hide();
        }else{
            $('#company_name_block').show();
            $('#br_block').show();
        }


    });
</script>
@endsection
