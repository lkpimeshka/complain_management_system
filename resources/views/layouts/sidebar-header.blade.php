<?php
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use App\Models\UserDetail;

    if(Auth::id()){
        $user = User::find(Auth::id());
    }

?>

<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ asset('images/profile_pic/default-profile.jpg') }}" class="img-circle elevation-2 image-previewer" style="width: 50px;" alt="User Image">
    </div>
    <div class="info">
        @if(Auth::id())
            <a href="{{ URL::to('view-user/'.$user->id) }}" class="d-block" style="text-align: center">{{ $user->name }}</a>
        @else
            <a href=" " class="d-block" style="text-align: center">Guest User</a>
        @endif
    </div>
  </div>

@if(Auth::id())
    <!-- SidebarSearch Form -->
    <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
        <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
        </button>
        </div>
    </div>
    </div>
@endif


