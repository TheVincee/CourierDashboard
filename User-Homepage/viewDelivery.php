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

    // Debugging: Log the entire $_GET array
    error_log('$_GET array: ' . print_r($_GET, true));

    // Check if 'id' is set in the GET request and is numeric
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']);

        // Debugging: Log the received ID value
        error_log('Received ID: ' . $_GET['id']);
        error_log('Processed ID: ' . $id);

        // Query to fetch details of a single delivery item based on the ID
        $stmt = $pdo->prepare("SELECT id, senderName, receiverName, senderEmail, senderPhone, destination, pickupTime, description, specificationDescription, status, trackingID FROM delivery_items WHERE id = ?");
        $stmt->execute([$id]);

        // Fetch the result
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            // Ensure status is not empty
            $item['status'] = $item['status'] ?? 'Pending';

            // Return a successful response with item details
            echo json_encode([
                'status' => 'success',
                'data' => $item
            ]);
        } else {
            // No item found with the given ID
            echo json_encode([
                'status' => 'error',
                'message' => 'No delivery item found.'
            ]);
        }
    } else {
        // Debugging: Log the error
        error_log('Invalid or missing ID parameter: ' . (isset($_GET['id']) ? $_GET['id'] : 'Not set'));
        
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid or missing ID parameter.'
        ]);
    }
} catch (PDOException $e) {
    // Return error response in case of a database failure
    echo json_encode([
        'status' => 'error',
        'message' => 'Error fetching delivery item details: ' . $e->getMessage()
    ]);
}
?>