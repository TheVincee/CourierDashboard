<?php
header('Content-Type: application/json');

try {
    // Replace with your actual database credentials
    $host = 'localhost';  // Database host
    $dbname = 'courier_db';  // Database name
    $username = 'root';  // Database username (change if needed)
    $password = '';  // Database password (if any)

    // Establish PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch delivery items with "Cancelled" status
    $stmt = $pdo->prepare("SELECT senderName, trackingID, cancellationReason FROM delivery_items WHERE status = 'Cancelled'");
    $stmt->execute();

    // Fetch all results
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($items) {
        // Return a successful response with item details
        echo json_encode([
            'status' => 'success',
            'data' => $items
        ]);
    } else {
        // No cancelled items found
        echo json_encode([
            'status' => 'error',
            'message' => 'No cancelled delivery items found.'
        ]);
    }
} catch (PDOException $e) {
    // Return error response in case of a database failure
    echo json_encode([
        'status' => 'error',
        'message' => 'Error fetching cancelled delivery items: ' . $e->getMessage()
    ]);
}
?>