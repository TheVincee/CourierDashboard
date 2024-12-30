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

    // Log input data for debugging (optional)
    error_log("Received data: " . print_r($input, true));

    // Validate required fields
    if (!isset($input['id']) || !isset($input['senderName']) || !isset($input['receiverName']) || !isset($input['senderEmail']) || !isset($input['senderPhone']) || !isset($input['destination']) || !isset($input['pickupTime']) || !isset($input['description']) || !isset($input['specificationDescription']) || !isset($input['status'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing required fields'
        ]);
        exit;
    }

    // Prepare the update query
    $sql = "UPDATE delivery_items SET 
                senderName = ?, 
                receiverName = ?, 
                senderEmail = ?, 
                senderPhone = ?, 
                destination = ?, 
                pickupTime = ?, 
                description = ?, 
                specificationDescription = ?, 
                status = ?";

    // Check if trackingID is set, add it to the query if provided
    if (isset($input['trackingID'])) {
        $sql .= ", trackingID = ?";
    }

    // Add the WHERE clause to the query
    $sql .= " WHERE id = ?";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the values for the statement
    $params = [
        $input['senderName'],
        $input['receiverName'],
        $input['senderEmail'],
        $input['senderPhone'],
        $input['destination'],
        $input['pickupTime'],
        $input['description'],
        $input['specificationDescription'],
        $input['status']
    ];

    // If trackingID is provided, add it to the params
    if (isset($input['trackingID'])) {
        $params[] = $input['trackingID'];
    }

    // Add the ID at the end of the params array
    $params[] = $input['id'];

    // Execute the update query
    $stmt->execute($params);

    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Item updated successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to update item, no rows affected'
        ]);
    }

} catch (PDOException $e) {
    // Log error for debugging
    error_log("Error: " . $e->getMessage());

    // Return error response in case of a database failure
    echo json_encode([
        'status' => 'error',
        'message' => 'Error updating delivery item: ' . $e->getMessage()
    ]);
}
?>
