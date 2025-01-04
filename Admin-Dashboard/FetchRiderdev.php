<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "courier_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch riders from the database
$ridersQuery = $mysqli->query("SELECT riders_id, first_name, last_name FROM riders");

$riders = [];
if ($ridersQuery->num_rows > 0) {
    while ($row = $ridersQuery->fetch_assoc()) {
        $riders[] = $row;
    }
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($riders);

$mysqli->close();
?>