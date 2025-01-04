<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "courier_db");

// Check connection
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $mysqli->connect_error]);
    exit;
}

// Fetch riders from the database
$ridersQuery = $mysqli->query("SELECT riders_id, first_name, last_name FROM riders");

$riders = [];
if ($ridersQuery->num_rows > 0) {
    while ($row = $ridersQuery->fetch_assoc()) {
        $riders[] = $row;
    }
} else {
    // No riders available
    echo json_encode(['success' => false, 'message' => 'No riders available.']);
    $mysqli->close();
    exit;
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode(['success' => true, 'riders' => $riders]);

$mysqli->close();
?>