<?php
// search_results.php

// Include your database connection file
include 'includes/dbconnect.php';

// Get the search query from the GET request
$searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Sanitize the search query to prevent SQL Injection
$searchTerm = "%{$searchQuery}%";

// Prepare the SQL query
$sql = "SELECT * FROM complaints WHERE subject LIKE :searchTerm OR complaint_type LIKE :searchTerm ORDER BY date DESC";

$stmt = $pdo->prepare($sql);

// Execute the query with the sanitized search term
$stmt->execute(['searchTerm' => $searchTerm]);

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>

<div class="container mt-4">
    <h2>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Engineer Status</th>
                <th>Complaint Type</th>
                <th>Product Serial No.</th>
                <th>Opened Since</th>
                <!-- Add other headers if needed -->
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo htmlspecialchars($row['engineer_status']); ?></td>
                        <td><?php echo htmlspecialchars($row['complaint_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_serial']); ?></td>
                        <td><?php echo htmlspecialchars($row['opened_since']); ?></td>
                        <!-- Add other columns if needed -->
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No results found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
