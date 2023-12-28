<?php
// functions.php

/**
 * Redirects to a specific page.
 *
 * @param string $url The URL to redirect to.
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Escapes HTML for output.
 *
 * @param string $text The text to be escaped.
 * @return string The escaped HTML.
 */
function escapeHTML($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Fetches complaints from the database.
 *
 * @param PDO $pdo The PDO connection object.
 * @return array An array of complaints.
 */
function getComplaints($pdo) {
    $stmt = $pdo->query("SELECT * FROM complaints ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Counts the total number of items in a table.
 *
 * @param PDO $pdo The PDO connection object.
 * @param string $tableName The name of the table to count items in.
 * @return int The count of items.
 */
function countItemsInTable($pdo, $tableName) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM $tableName");
    return (int) $stmt->fetchColumn();
}
