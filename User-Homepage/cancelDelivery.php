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

    // Get the input data
    $input = json_decode(file_get_contents('php://input'), true);

    // Check if the 'id' is set in the input data
    if (!isset($input['id']) || !is_numeric($input['id'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid or missing ID parameter.'
        ]);
        exit;
    }

    $id = intval($input['id']);

    // Update the status of the delivery item to 'Cancelled'
    $stmt = $pdo->prepare("UPDATE delivery_items SET status = 'Cancelled' WHERE id = ?");
    $stmt->execute([$id]);

    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Delivery item cancelled successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to cancel delivery item.'
        ]);
    }
} catch (PDOException $e) {
    // Return error response in case of a database failure
    echo json_encode([
        'status' => 'error',
        'message' => 'Error cancelling delivery item: ' . $e->getMessage()
    ]);
}
?>