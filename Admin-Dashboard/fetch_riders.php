<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "courier_db"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Updated query to include the new fields (password, role, created_at)
$query = "SELECT riders_id, first_name, last_name, email, contact, vehicle_type, username, password, role, created_at FROM riders";
$result = $conn->query($query);

$riders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $riders[] = $row; // Add each rider to the array
    }
}

header('Content-Type: application/json');
echo json_encode(['success' => true, 'riders' => $riders]);

$conn->close();
?>
