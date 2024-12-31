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

// Function to fetch cancelled bookings
function fetchCancelledBookings() {
    $pdo = getDbConnection();  // Get database connection

    // Query to fetch cancelled bookings
    $stmt = $pdo->prepare("SELECT bookingID, name, cancellation_reason, cancelled_at FROM bookings WHERE status = 'cancelled' ORDER BY cancellation_reason ASC");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Return the fetched data
}

// Fetch the cancelled bookings data
$bookings = fetchCancelledBookings();

if ($bookings) {
    // Return a success response with the fetched data
    echo json_encode([
        'status' => 'success',
        'data' => $bookings
    ]);
} else {
    // No bookings found
    echo json_encode([
        'status' => 'error',
        'message' => 'No cancelled bookings found.'
    ]);
}
?>