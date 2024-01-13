<!-- complaint_table.php -->
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Complaint Type</th>
            <th>Location</th>
            <th>Status</th>
            <th>Created Date</th>
        </tr>
        </thead>
        <tbody>
        @if (count($complaints) == 0)
            <tr style="text-align: center">
                <td colspan="5">No complaints to display.</td>
            </tr>
        @else
            <?php foreach ($complaints as $complaint): ?>
                <?php

                    $statusModel = App\Models\Status::where('id', $complaint->status)->first();
                    if($complaint->status != 1){
                        if($complaint->status == 2){
                            $activityRecord = App\Models\Assign::where('complaint_id', $complaint->id)->where('activity_type', 1)->first();
                        }
                    }
                    $complaner = App\Models\User::where('id',$complaint->txtcomplainer_id)->first();
                    $problem = App\Models\Problem::where('id',$complaint->problem_type)->first();
                    $branch = App\Models\Branch::where('id',$complaint->location)->first();

                ?>
                <tr>
                    <td>{{$complaint->id}}</td>
                    <td>{{$problem->name}}</td>
                    <td>{{$branch->name}}</td>
                    <td>{{$statusModel->name}}</td>
                    <td>{{$complaint->created_at}}</td>
                </tr>
            <?php endforeach; ?>
        @endif
        </tbody>
    </table>
  </div>
