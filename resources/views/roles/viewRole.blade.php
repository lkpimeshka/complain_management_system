@extends('layouts.app')

@section('content')
<div class="container">
    <br/>
    <div class="card" style="padding: 1rem;">

        <div class="row" style="padding-top: 20px; padding-bottom: 30px;">
            <div class="col-sm-12">
                <h2>Role #{{$role->id}} | View</h2>
                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h4 style="margin-bottom: 15px;">Role Info</h4>
            </div>     

            <div class="col-sm-12" style="margin-left: 10px">
                <div class="row">
                    <div class="col-sm-4">
                        <label>Name</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$role->name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Institute</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$role->institutes_name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Description</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$role->description}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Created Date</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$role->created_at}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Updated Date</label>
                    </div>
                    <div class="col-sm-8">
                        <p>{{$role->updated_at}}</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <h4 style="margin-top: 15px; margin-bottom: 15px;">Account Privileges</h4>
                <hr/>
            </div>

            @if($privileges)
                @foreach($privileges as $privilege)
                    <div class="col-sm-6 col-md-4 col-lg-3" style="margin-bottom: 5px;">
                        <?php
                            $model = App\Models\Privilege::find($privilege);
                        ?>
                        <div class="card" style="padding: .5rem">
                            <label style="text-align: center;">{{$model->name}}</label>
                        </div>
                    </div>
                @endforeach
            @else

            <div class="col-sm-12" style="margin-bottom: 5px;">
                <p style="text-align: center">- No Privilege Found -</p>
            </div>
            
            @endif    

        </div>
    </div>
</div>
@endsection


