@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1 class="m-0">Dashboard</h1> --}}
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::has('danger'))
            <div class="alert alert-danger text-center">
                {{Session::get('danger')}}
            </div>
        @endif

        <div class="container mt-4">
      
          
      
          <!-- Include Search Bar -->
          {{-- @include('dashboard/templates/searchbar') --}}
      
          <!-- Complaints Table -->
          <div class="row">
            <div class="col-sm-8">
              <h2>Recent Complaints</h2>
            </div>
            <div class="col-sm-4" style="text-align: right">
              <a href="{{url('complain/list')}}" class="btn btn-info btn-sm" title="View More Complaints"  data-toggle="tooltip">View More</a>
            </div>
          </div>

          @include('dashboard/templates/complaint_table')

          <hr style="margin-bottom: 30px" />
      
          <!-- Include Status Boxes -->
          @include('dashboard/templates/status_boxes')

        </div>

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('script')
@if(Session::has('error'))
  <script>
    toastr.error("{{ Session::get('error') }}");
  </script>
@endif
@endsection