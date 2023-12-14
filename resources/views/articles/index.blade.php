@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 style="padding-top: 20px; padding-bottom: 10px;">Articles Table</h2>
        </div>

        <div class="col-md-6">
            <a href="{{url('article/create')}}" class="btn btn-md btn-success" style="margin-top: 20px; float: right">Create Article</a>
        </div>
    </div>
    <hr/>

    <table id="example" class="display nowrap" style="width:100%; padding-top: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if($articles)
                @foreach ($articles as $k => $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->description}}</td>
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
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th></th>
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