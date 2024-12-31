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

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$pickupAddress = isset($_POST['pickupAddress']) ? trim($_POST['pickupAddress']) : '';
$dropoffAddress = isset($_POST['dropoffAddress']) ? trim($_POST['dropoffAddress']) : '';
$pickupDistance = isset($_POST['pickupDistance']) ? floatval($_POST['pickupDistance']) : 0;
$dropoffDistance = isset($_POST['dropoffDistance']) ? floatval($_POST['dropoffDistance']) : 0;
$totalAmount = isset($_POST['totalAmount']) ? floatval($_POST['totalAmount']) : 0;
$status = 'pending';

// Log the phone number for debugging
error_log("Phone number received: " . $phone);

// Basic validation (ensure all required fields are filled)
if (empty($name) || empty($phone) || empty($pickupAddress) || empty($dropoffAddress)) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
    exit;
}

if ($pickupDistance <= 0 || $dropoffDistance <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Distances must be greater than zero.']);
    exit;
}

// Calculate the total distance
$totalDistance = $pickupDistance + $dropoffDistance;

// Assuming a fixed rate of ₱10 per km (you can modify this rate)
$ratePerKm = 10;
$calculatedTotalAmount = $totalDistance * $ratePerKm;

// Ensure the provided totalAmount matches the calculated totalAmount
if (abs($totalAmount - $calculatedTotalAmount) > 0.01) { // Allow a small margin of error
    echo json_encode(['status' => 'error', 'message' => 'Total amount mismatch.']);
    exit;
}

// If all validations pass, proceed with booking (e.g., save to database)
$sql = "INSERT INTO bookings (name, phone, pickupAddress, dropoffAddress, pickupDistance, dropoffDistance, totalDistance, totalPayable, createdAt)
        VALUES ('$name', '$phone', '$pickupAddress', '$dropoffAddress', $pickupDistance, $dropoffDistance, $totalDistance, $totalAmount, NOW())";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Booking added successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
