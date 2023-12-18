@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 style="padding-top: 20px; padding-bottom: 10px;">Complaints and reviews</h2>
        </div>

        <div class="col-md-6">
            <a href="{{url('complain/create')}}" class="btn btn-md btn-success" style="margin-top: 20px; float: right">New Complaint</a>
        </div>
    </div>
    <hr/>

    <table id="datatable" class="display nowrap" style="width:100%; padding-top: 20px;">
        <thead>
            <tr>
                <th>Complait ID</th>
                <th>Complainer ID</th>
                <th>Location</th>
                <th>Problem Type</th>
                <th>Description</th>
                <th>Attachments</th>
                <th>Complaint Date</th>
                <th>Last update Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if($complaints)
                @foreach ($complaints as $k => $complaints)
                    <tr>
                        <td>{{$complaints->id}}</td>
                        <td>{{$complaints->txtcomplainer_id}}</td>
                        <td>{{$complaints->location}}</td>
                        <td>{{$complaints->problem_type}}</td>
                        <td>{{$complaints->txtcomplaint_remarks}}</td>
                        <td>{{$complaints->FileDocumentAttachment}}</td>
                        <td>{{$complaints->created_at}}</td>
                        <td>{{$complaints->updated_at}}</td>
                        <td>
                            <a href="{{url('complain/view/'.$complaints->id)}}" class="btn btn-success btn-sm" title ="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('complain/edit/'.$complaints->id)}}" class="btn btn-primary btn-sm" title ="Edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                            <a href="{{url('complain/delete/'.$complaints->id)}}" class="btn btn-danger btn-sm" title ="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
        <tr>
                <th>Complait ID</th>
                <th>Complainer ID</th>
                <th>Location</th>
                <th>Problem Type</th>
                <th>Description</th>
                <th>Attachments</th>
                <th>Complaint Date</th>
                <th>Last update Date</th>
                
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@section('script')
    @if(Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
@endsection