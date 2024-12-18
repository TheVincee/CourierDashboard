<?php
// fetch_riders.php

header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "courier_db";  // Replace with your actual database name

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    // Return an error message in JSON format
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

$sql = "SELECT id, first_name, last_name, email, contact, vehicle_type, username FROM riders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $riders = [];
    while ($row = $result->fetch_assoc()) {
        $riders[] = $row;  // Add each rider to the array
    }
    // Return the array of riders as a JSON response
    echo json_encode(['success' => true, 'riders' => $riders]);
} else {
    // Return an empty array if no riders found
    echo json_encode(['success' => false, 'message' => 'No riders found.']);
}

$conn->close();
?>
