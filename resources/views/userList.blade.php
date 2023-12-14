@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<script type="text/javascript">
    token = "{{ csrf_token() }}"
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-5">
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(function () {
      // var SSPEnable = true
      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              url:'{{ route('users.list') }}',
              type:'POST',
              headers: {'X-CSRF-TOKEN': token},
              dataType: 'JSON',
              beforeSend: function (xhr) {
                  xhr.setRequestHeader('Authorization');
              }
          },
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'city', name: 'city'},
              {data: 'telephone', name: 'telephone'},
              {data: 'action',orderable: false, searchable: false},
          ]
      });

    });
</script>

@endsection

