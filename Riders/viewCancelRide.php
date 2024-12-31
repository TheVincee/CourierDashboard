<?php
header('Content-Type: application/json');

// Function to create a database connection
function getDbConnection() {
    // Database credentials
    $host = 'localhost';  // Database host
    $dbname = 'courier_db';  // Database name
    $username = 'root';  // Database username
    $password = '';  // Database password (if any)

    try {
        // Create PDO connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Log the error and return a generic error message
        error_log('PDOException: ' . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
        exit;
    }
}

// Function to fetch cancelled ride details by booking ID
function fetchCancelledRideDetails($bookingID) {
    $pdo = getDbConnection();  // Get database connection

    // Query to fetch details of a cancelled ride by booking ID
    $stmt = $pdo->prepare("SELECT bookingID, name, phone, pickupAddress, dropoffAddress, pickupDistance, dropoffDistance, totalDistance, totalPayable, createdAt, status, cancellation_reason, cancelled_at FROM bookings WHERE bookingID = :bookingID AND status = 'cancelled' LIMIT 1");
    $stmt->bindParam(':bookingID', $bookingID, PDO::PARAM_INT);  // Bind the booking ID parameter securely

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);  // Return the fetched data
}

// Check if the 'bookingID' parameter is set and is numeric
if (isset($_GET['bookingID']) && is_numeric($_GET['bookingID'])) {
    $bookingID = intval($_GET['bookingID']);  // Secure the booking ID by converting it to an integer

    // Debugging: Log the received booking ID
    error_log("Received Booking ID: $bookingID");

    // Fetch the cancelled ride details
    $rideDetails = fetchCancelledRideDetails($bookingID);

    if ($rideDetails) {
        // Return a success response with the fetched data
        echo json_encode([
            'status' => 'success',
            'data' => $rideDetails
        ]);
    } else {
        // No ride found with the provided booking ID
        error_log("No cancelled ride found with Booking ID: $bookingID");
        echo json_encode([
            'status' => 'error',
            'message' => 'No cancelled ride found with the given Booking ID.'
        ]);
    }
} else {
    // If the 'bookingID' parameter is missing or invalid
    error_log("Invalid or missing Booking ID parameter: " . (isset($_GET['bookingID']) ? $_GET['bookingID'] : 'Not set'));
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid or missing Booking ID parameter. Please provide a valid numeric Booking ID.'
    ]);
}
?>