@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 style="padding-top: 20px; padding-bottom: 10px;">Users Table</h2>
        </div>

        <div class="col-md-6">
            <a href="{{url('user/create')}}" class="btn btn-md btn-success" style="margin-top: 20px; float: right">Add User</a>
        </div>
    </div>
    <hr/>

    <table id="datatable" class="display nowrap datatable" style="width:100%; padding-top: 20px;">
        <thead>
            <tr>
                <th>Complait ID</th>
                <th>Complainer</th>
                <th>Location</th>
                <th>Problem Type</th>
                <th>Description</th>
                <th>Complaint Date</th>
                <th>Last update Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if($complaints)
                @foreach ($complaints as $k => $complaint)


                    <tr>
                    <td>{{$complaint->id}}</td>
                        <td>{{$complaint->txtcomplainer_id}}</td>
                        <td>{{$complaint->location}}</td>
                        <td>{{$complaint->problem_type}}</td>
                        <td>{{$complaint->txtcomplaint_remarks}}</td>
                        <td>{{$complaint->created_at}}</td>
                        <td>{{$complaint->updated_at}}</td>
                        <td>
                            <a href="{{ url('assigns/assignUser/'.$complaint->id)}}" class="btn btn-success btn-sm"  style="margin-bottom: 10px; margin-top: 10px ">Assign To</a>
                            <a href="{{url('complain/view/'.$complaint->id)}}" class="btn btn-success btn-sm" title ="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('complain/edit/'.$complaint->id)}}" class="btn btn-primary btn-sm" title ="Edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
