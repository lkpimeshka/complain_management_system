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
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Telepehone</th>
                <th>Role</th>
                @if($role == 1)
                    <th>Institute</th>
                @endif
                <th>City</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if($users)
                @foreach ($users as $k => $user)
                    <?php
                        if($role == 1){
                            $roleModal = App\Models\Role::join('institutes', 'roles.institute', 'institutes.id')
                                            ->where('roles.id', $user->role)
                                            ->first([
                                                'roles.name as role_name',
                                                'institutes.name as institutes_name',
                                            ]);
                            $roleName = $roleModal->role_name;

                        }else{
                            $roleModal = App\Models\Role::where('id', $user->role)->first();
                            $roleName = $roleModal->name;
                        }
                    ?>

                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->telephone}}</td>
                        <td>{{$roleName}}</td>
                        @if($role == 1)
                            <td>{{$roleModal->institutes_name}}</td>
                        @endif
                        <td>{{$user->city}}</td>
                        <td>
                            <a href="{{url('user/view/'.$user->id)}}" class="btn btn-success btn-sm" title ="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('user/edit/'.$user->id)}}" class="btn btn-primary btn-sm" title ="Edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                            <button type="button" data-id="{{$user->id}}" data-toggle="modal" data-target="#DeleteModal" class="btn btn-danger btn-sm" id="getDeleteId"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Delete user Modal -->
    <div class="modal" id="DeleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">User Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <h4>Are you sure want to delete this User?</h4>
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

    @if(Session::has('error'))
        <script>
            toastr.error("{{ Session::get('error') }}");
        </script>
    @endif

    @if(Session::has('warning'))
        <script>
            toastr.warning("{{ Session::get('warning') }}");
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
                    url: "/user/delete/"+id,
                    method: 'GET',
                    success: function(result) {
                        $('#DeleteModal').hide();
                        localStorage.setItem("success-alert", result.success);
                        // alert(result.success);
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        localStorage.setItem("error-alert", xhr.responseJSON.error);
                        // alert(xhr.responseJSON.error);
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection