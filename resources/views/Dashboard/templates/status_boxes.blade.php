<?php 
    use Illuminate\Support\Facades\Auth; 
    
    
?>
<!-- status_boxes.php -->

<div class="status-boxes-container">
    <div class="row">
        <!-- Each status box will be a column in the row -->

        @if(Auth::user()->role == 4)
            <div class="col">
                <div class="status-box registered-users">
                    <i class="fa fa-users fa-2x" aria-hidden="true"></i>
                    <h3>{{Auth::user()->email}}</h3>
                    <p>{{Auth::user()->name}}</p>
                </div>
            </div>
        @else
        <div class="col">
            <div class="status-box registered-users">
                <i class="fa fa-users fa-2x" aria-hidden="true"></i>
                <h3>Registered Users</h3>
                <p>{{count($users)}}</p>
            </div>
        </div>
        @endif

        <div class="col">
            <a href="{{url('complain/list')}}">
            <div class="status-box total-complaints">
                <i class="fa fa-list fa-2x" aria-hidden="true"></i>
                <h3>Total Complaints</h3>
                <p>{{count($totalComplaints)}}</p>
            </div>
            </a>
        </div>

        <div class="col">
            <div class="status-box officer-feedback">
                <i class="fa fa-comments fa-2x" aria-hidden="true"></i>
                <h3>Pending Complaints</h3>
                <p>{{count($pendingComplaints)}}</p>
            </div>
        </div>

        <div class="col">
            <div class="status-box solved-complaints">
                <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
                <h3>Solved Complaints</h3>
                <p>{{count($completedComplaints)}}</p>
            </div>
        </div>

    </div>
</div>
