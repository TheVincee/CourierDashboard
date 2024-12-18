<?php
// Database connection details
$host = 'localhost';
$dbname = 'courier_db';
$username = 'root';
$password = '';

function sendResponse($message, $data = null) {
    echo json_encode(['message' => $message, 'data' => $data]);
    exit;
}

try {
    // Establish database connection using PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get and decode JSON data from the request
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        sendResponse('Error: No data received');
    }

    // Validate required fields
    $requiredFields = [
        'senderName', 'receiverName', 'senderEmail', 'senderPhone',
        'destination', 'pickupTime', 'paymentType', 'description', 'specificationDescription'
    ];

    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            sendResponse("Error: $field is required");
        }
    }

    // Validate email format
    if (!filter_var($data['senderEmail'], FILTER_VALIDATE_EMAIL)) {
        sendResponse('Error: Invalid email format');
    }

    // Sanitize and trim pickupTime
    $pickupTime = trim($data['pickupTime']);

    // Debugging: Check the received pickupTime
    error_log("Received pickupTime: " . $pickupTime);

    // Check if pickupTime has both date and time in the correct format
    if (empty($pickupTime) || !preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $pickupTime)) {
        sendResponse("Error: Invalid pickup time format. Please use 'Y-m-d H:i:s'. Example: 2024-12-11 14:30:00");
    }

    // Validate and reformat pickupTime using DateTime
    try {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $pickupTime);
        $errors = DateTime::getLastErrors();

        // If there are errors in the date format, send error message
        if ($errors['error_count'] > 0 || $errors['warning_count'] > 0 || !$dateTime) {
            sendResponse("Error: Invalid pickup time format. Please use 'Y-m-d H:i:s'. Example: 2024-12-11 14:30:00");
        }

        // Correct the pickup time format to be sure it's inserted correctly
        $pickupTime = $dateTime->format('Y-m-d H:i:s'); // Ensure the format is correct
    } catch (Exception $e) {
        sendResponse("Error: Invalid pickup time. Exception: " . $e->getMessage());
    }

    // Prepare the SQL query
    $query = "
        INSERT INTO delivery_items 
        (
            senderName, receiverName, senderEmail, senderPhone, 
            destination, pickupTime, paymentType, description, specificationDescription, 
            status, created_at, updated_at
        ) 
        VALUES 
        (
            :senderName, :receiverName, :senderEmail, :senderPhone, 
            :destination, :pickupTime, :paymentType, :description, :specificationDescription, 
            :status, NOW(), NOW()
        )
    ";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind parameters
    $params = [
        ':senderName' => $data['senderName'],
        ':receiverName' => $data['receiverName'],
        ':senderEmail' => $data['senderEmail'],
        ':senderPhone' => $data['senderPhone'],
        ':destination' => $data['destination'],
        ':pickupTime' => $pickupTime,
        ':paymentType' => $data['paymentType'],
        ':description' => $data['description'],
        ':specificationDescription' => $data['specificationDescription'],
        ':status' => $data['status'] ?? 'Pending',  // Default status if not provided
    ];

    // Execute the query
    if ($stmt->execute($params)) {
        sendResponse('Item added successfully');
    } else {
        $errorInfo = $stmt->errorInfo();
        error_log("Insert Error: " . print_r($errorInfo, true));
        sendResponse('Error adding item', $errorInfo[2]);
    }
} catch (PDOException $e) {
    error_log("PDO Error: " . $e->getMessage());
    sendResponse('Database error', $e->getMessage());
} catch (Exception $e) {
    error_log("General Error: " . $e->getMessage());
    sendResponse('Error', $e->getMessage());
}
?>
