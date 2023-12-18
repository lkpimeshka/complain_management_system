@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 style="padding-top: 20px; padding-bottom: 10px;">Roles Table</h2>
        </div>

        <div class="col-md-6">
            <a href="{{url('role/create')}}" class="btn btn-md btn-success" style="margin-top: 20px; float: right">Create Role</a>
        </div>
    </div>
    <hr/>

    <table id="datatable" class="display nowrap datatable" style="width:100%; padding-top: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Institute</th>
                <th>Description</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if($roles)
                @foreach ($roles as $k => $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->institutes_name}}</td>
                        <td>{{$role->description}}</td>
                        <td>{{$role->created_at}}</td>
                        <td>{{$role->updated_at}}</td>
                        <td>
                            <a href="{{url('role/view/'.$role->id)}}" class="btn btn-success btn-sm" title ="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('role/edit/'.$role->id)}}" class="btn btn-primary btn-sm" title ="Edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                            <button type="button" data-id="{{$role->id}}" data-toggle="modal" data-target="#DeleteRoleModal" class="btn btn-danger btn-sm" id="getDeleteId"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Delete Role Modal -->
<div class="modal" id="DeleteRoleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Role Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Are you sure want to delete this Role?</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="SubmitDeleteRoleForm">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
    @if(Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
        </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {

            if(localStorage.getItem("success-alert")){
                toastr.success(localStorage.getItem("success-alert"));
                localStorage.removeItem("success-alert");
            }

            if(localStorage.getItem("error-alert")){
                toastr.error(localStorage.getItem("error-alert"));
                localStorage.removeItem("error-alert");
            }
    
            var deleteID;
            $('body').on('click', '#getDeleteId', function(){
                deleteID = $(this).data('id');
            })
            $('#SubmitDeleteRoleForm').click(function(e) {
                e.preventDefault();
                var id = deleteID;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/role/delete/"+id,
                    method: 'GET',
                    success: function(result) {
                        $('#DeleteRoleModal').hide();
                        localStorage.setItem("success-alert", result.success);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        localStorage.setItem("error-alert", xhr.responseJSON.error);
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection