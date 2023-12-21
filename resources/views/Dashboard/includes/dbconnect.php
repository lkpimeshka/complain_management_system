

<?php
// dbconnect.php

$host = 'localhost';  // The host name where your MySQL server is running
$db   = 'admin_dashboard';  // Replace with the name of your database
$user = 'root';  // The default username for MySQL is 'root'
$pass = 'root';  // The default password for MySQL is empty after installation with Homebrew
$charset = 'utf8mb4';



// Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Options for the PDO connection
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Create a new PDO instance and connect to the database
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

