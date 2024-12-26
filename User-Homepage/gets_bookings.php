<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "courier_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Fetch bookings from the database
$sql = "SELECT bookingID, name, phone, pickupAddress, dropoffAddress, pickupDistance, dropoffDistance, totalDistance, totalPayable, createdAt FROM bookings";
$result = $conn->query($sql);

$bookings = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
} else {
    // No bookings found
    $bookings = [];
}

// Return the bookings as a JSON response
echo json_encode($bookings);

$conn->close();
?>