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

// Function to fetch booked rides
function fetchBookedRides() {
    $pdo = getDbConnection();  // Get database connection

    // Query to fetch booked rides
    $stmt = $pdo->prepare("SELECT bookingID, name, phone, pickupAddress, dropoffAddress, status FROM bookings");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Return the fetched data
}

// Fetch the booked rides data
$rides = fetchBookedRides();

if ($rides) {
    // Return a success response with the fetched data
    echo json_encode([
        'status' => 'success',
        'data' => $rides
    ]);
} else {
    // No rides found
    echo json_encode([
        'status' => 'error',
        'message' => 'No booked rides found.'
    ]);
}
?>