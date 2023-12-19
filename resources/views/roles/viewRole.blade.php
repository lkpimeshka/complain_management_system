@extends('layouts.app')

@section('content')
<div class="container">

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

        <div class="col-sm-12">
            <table class="table" style="width: 100%">
                <tbody>
                    <tr><th style="width: 35%">Name</th><td>{{$role->name}}</td></tr>
                    <tr><th style="width: 35%">Institute</th><td>{{$role->institutes_name}}</td></tr>
                    <tr><th style="width: 35%">Description</th><td>{{$role->description}}</td></tr>
                    <tr><th style="width: 35%">Created Date</th><td>{{$role->created_at}}</td></tr>
                    <tr><th style="width: 35%">Updated Date</th><td>{{$role->updated_at}}</td></tr>
                </tbody>
            </table>
        </div>

        <div class="col-sm-12">
            <h4 style="margin-top: 15px; margin-bottom: 15px;">Account Privileges</h4>
            <hr/>
        </div>

        @if($privileges)
            @foreach($privileges as $privilege)
                <div class="col-sm-6 col-md-4 col-lg-3" style="margin-bottom: 5px;">
                    <p>
                        <?php
                            $model = App\Models\Privilege::find($privilege);
                            echo $model->name;
                        ?>
                    </p>
                </div>
            @endforeach
        @else

        <div class="col-sm-12" style="margin-bottom: 5px;">
            <p style="text-align: center">- No Privilege Found -</p>
        </div>
        
        @endif    

    </div>
</div>
@endsection


