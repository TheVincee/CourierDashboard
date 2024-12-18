<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "courier_db"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$query = "SELECT id, first_name, last_name, email, contact, vehicle_type, username FROM riders";
$result = $conn->query($query);

$riders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $riders[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($riders);

$conn->close();
?>
