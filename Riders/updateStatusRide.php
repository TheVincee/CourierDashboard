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

// Function to update ride status
function updateRideStatus($bookingID, $status) {
    $pdo = getDbConnection();  // Get database connection

    // Query to update the status of a ride
    $stmt = $pdo->prepare("UPDATE bookings SET status = :status WHERE bookingID = :bookingID");
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':bookingID', $bookingID, PDO::PARAM_INT);

    return $stmt->execute();  // Return the result of the update operation
}

// Check if the 'bookingID' and 'status' parameters are set
if (isset($_POST['bookingID']) && isset($_POST['status'])) {
    $bookingID = intval($_POST['bookingID']);  // Secure the booking ID by converting it to an integer
    $status = $_POST['status'];  // Get the status

    // Debugging: Log the received parameters
    error_log("Received Booking ID: $bookingID, Status: $status");

    // Update the ride status
    $result = updateRideStatus($bookingID, $status);

    if ($result) {
        // Return a success response
        echo json_encode([
            'status' => 'success',
            'message' => 'Ride status updated successfully.'
        ]);
    } else {
        // Failed to update the ride status
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to update ride status.'
        ]);
    }
} else {
    // If the 'bookingID' or 'status' parameter is missing
    error_log("Invalid or missing parameters: bookingID or status");
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid or missing parameters. Please provide a valid bookingID and status.'
    ]);
}
?>