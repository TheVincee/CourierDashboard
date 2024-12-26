<?php
// Load database configuration
$config = include('config.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log all request data
error_log('REQUEST_METHOD: ' . $_SERVER['REQUEST_METHOD']);
error_log('GET Data: ' . print_r($_GET, true));
error_log('POST Data: ' . print_r($_POST, true));

// Create connection
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

// Get booking ID from GET
$bookingID = isset($_GET['bookingID']) ? intval($_GET['bookingID']) : 0;

error_log('Processed bookingID: ' . $bookingID);

if ($bookingID <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid booking ID']);
    exit;
}

$sql = "SELECT bookingID, name, phone, pickupAddress, dropoffAddress, 
        pickupDistance, dropoffDistance, totalDistance, totalPayable, 
        status, cancellation_reason
        FROM bookings 
        WHERE bookingID = $bookingID LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Booking not found']);
    exit;
}

$booking = $result->fetch_assoc();

// Format numbers
$booking['pickupDistance'] = number_format((float)$booking['pickupDistance'], 2);
$booking['dropoffDistance'] = number_format((float)$booking['dropoffDistance'], 2);
$booking['totalDistance'] = number_format((float)$booking['totalDistance'], 2);
$booking['totalPayable'] = isset($booking['totalPayable']) ? number_format((float)$booking['totalPayable'], 2) : null;

echo json_encode(['status' => 'success', 'data' => $booking]);

$conn->close();
?>