
<!-- complaint_table.php -->
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Complaint Type</th>
                <th>Complaint serial No.</th>
                <th>Opened Since</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($complaints as $complaint): ?>
            <tr>
                <td><?= htmlspecialchars($complaint['id']) ?></td>
                <td><?= htmlspecialchars($complaint['subject']) ?></td>
                <td><?= htmlspecialchars($complaint['complaint_type']) ?></td>
                <td><?= htmlspecialchars($complaint['Complaint_serial_no']) ?></td>
                <td><?= htmlspecialchars($complaint['opened_since']) ?></td>
                <td>
                    <!-- Actions like View, Edit, Delete -->
                    <a href="view_complaint.php?id=<?= $complaint['id'] ?>" class="view" title="View" data-toggle="tooltip"><i class="fas fa-eye"></i></a>
                    <a href="edit_complaint.php?id=<?= $complaint['id'] ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                    <a href="delete_complaint.php?id=<?= $complaint['id'] ?>" class="delete" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
