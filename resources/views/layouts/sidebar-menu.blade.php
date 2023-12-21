<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

$currentUser = User::find(Auth::id());
?>

@auth
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link"> {{--<a href="{{ route('dashboard') }}" class="nav-link active"> --}}
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>

@if($currentUser->role == 1 || $currentUser->role == 2 || $currentUser->role == 3) <!-- Admin User -->
    <li class="nav-header">USER DETAILS</li>

    <li class="nav-item">
        <a href="{{ URL::to('role/list') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Roles
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ URL::to('user/list') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Users
            </p>
        </a>
    </li>
    
@elseif($currentUser->role == 4)

    <li class="nav-item">
        <a href="{{ URL::to('#') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                My Account
            </p>
        </a>
    </li>

    <li class="nav-header">COMPLAINTS DETAILS</li>

    <li class="nav-item">
        <a href="{{ URL::to('complain/list') }}" class="nav-link">
            <i class="fa fa-list nav-icon" style="font-size: 13px;"></i>
            <p>
                Complaints List
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ URL::to('complain/create') }}" class="nav-link">
            <i class="nav-icon fa fa-plus nav-icon"></i>
            <p>
                New Complaint
            </p>
        </a>
    </li>

@endif

@if($currentUser->role != 4)

    <li class="nav-header">COMPLAINTS DETAILS</li>

    <li class="nav-item">
        <a href="{{ URL::to('complain/list') }}" class="nav-link">
            <i class="fa fa-list nav-icon" style="font-size: 13px;"></i>
            <p>
                Complaints List
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ URL::to('complain/my-complaints') }}" class="nav-link">
            <i class="fa fa-list nav-icon" style="font-size: 13px;"></i>
            <p>
                Assigned Complaints
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ URL::to('complain/reassign-complaints') }}" class="nav-link">
            <i class="fa fa-list nav-icon" style="font-size: 13px;"></i>
            <p>
                Re-Assigned Complaints
            </p>
        </a>
    </li>

@endif

    </ul>
</nav>
<!-- /.sidebar-menu -->
@endauth
