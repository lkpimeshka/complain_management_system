<!-- status_boxes.php -->
<div class="status-boxes-container">
    <div class="row">
        <!-- Each status box will be a column in the row -->
        <div class="col">
            <div class="status-box total-complaints">
                <i class="fa fa-list fa-2x" aria-hidden="true"></i>
                <h3>Total Complaints</h3>
                <p><?= $totalComplaints ?></p>
            </div>
        </div>

        <div class="col">
            <div class="status-box registered-users">
                <i class="fa fa-users fa-2x" aria-hidden="true"></i>
                <h3>Registered Users</h3>
                <p><?= $registeredUsers ?></p>
            </div>
        </div>

        <div class="col">
            <div class="status-box solved-complaints">
                <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
                <h3>Solved Complaints</h3>
                <p><?= $solvedComplaints ?></p>
            </div>
        </div>

        <div class="col">
            <div class="status-box officer-feedback">
                <i class="fa fa-comments fa-2x" aria-hidden="true"></i>
                <h3>Officer Feedback</h3>
                <p><?= $officerFeedback ?></p>
            </div>
        </div>
    </div>
</div>
