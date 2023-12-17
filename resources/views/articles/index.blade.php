@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 style="padding-top: 20px; padding-bottom: 10px;">Complaints and reviews</h2>
        </div>

        <div class="col-md-6">
            <a href="{{url('article/create')}}" class="btn btn-md btn-success" style="margin-top: 20px; float: right">New Complaint</a>
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
            @if($articles)
                @foreach ($articles as $k => $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        <td>{{$article->txtcomplainer_id}}</td>
                        <td>{{$article->location}}</td>
                        <td>{{$article->problem_type}}</td>
                        <td>{{$article->txtcomplaint_remarks}}</td>
                        <td>{{$article->FileDocumentAttachment}}</td>
                        <td>{{$article->created_at}}</td>
                        <td>{{$article->updated_at}}</td>
                        <td>
                            <a href="{{url('article/view/'.$article->id)}}" class="btn btn-success btn-sm" title ="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('article/edit/'.$article->id)}}" class="btn btn-primary btn-sm" title ="Edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                            <a href="{{url('article/delete/'.$article->id)}}" class="btn btn-danger btn-sm" title ="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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