<?php
// Include necessary files
include '../includes/dbconnect.php'; // Adjust the path as needed
include '../includes/functions.php';

// Fetch data for the dashboard (modify queries as per your database schema)
$totalComplaints = countItemsInTable($pdo, 'complaints');
$registeredUsers = countItemsInTable($pdo, 'users');
$solvedComplaints = countItemsInTable($pdo, 'solved_complaints'); // Example table
$officerFeedback = countItemsInTable($pdo, 'officer_feedback'); // Example table

// Include the header 
include '../includes/header.php';
?>

<!-- Main Dashboard Content -->
<div class="container mt-4">
    <h1>Admin Dashboard</h1>



    <!-- Include Search Bar -->
    <?php include '../templates/searchbar.php'; ?>

    <!-- Complaints Table -->
    <h2>Recent Complaints</h2>
    <?php $complaints = getComplaints($pdo); ?>
    <?php include '../templates/complaint_table.php'; ?>

    <!-- Include Status Boxes -->
    <?php include '../templates/status_boxes.php'; ?>
</div>

<?php
// Include the footer if you have one
// include '../includes/footer.php';
?>

<!-- Optional: Custom Scripts for the Dashboard -->
<script src="assets/js/custom.js"></script>

</body>
</html>
