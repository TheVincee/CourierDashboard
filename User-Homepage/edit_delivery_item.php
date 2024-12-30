<?php
// Database connection details
$host = 'localhost';
$dbname = 'courier_db';
$username = 'root';
$password = '';

function sendResponse($message, $data = null, $status = 'error') {
    // Log the response
    error_log("Response: " . json_encode(['status' => $status, 'message' => $message, 'data' => $data]));
    // Outputting the response in a consistent format
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

try {
    // Establish database connection using PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get and decode JSON data from the request
    $data = json_decode(file_get_contents('php://input'), true);
    error_log("Received Data: " . print_r($data, true)); // Log the incoming data

    if (!$data) {
        sendResponse('Error: No data received');
    }

    // Validate required fields
    $requiredFields = [
        'id', 'senderName', 'receiverName', 'senderEmail', 'senderPhone',
        'destination', 'pickupTime', 'paymentType', 'description', 'specificationDescription'
    ];

    $missingFields = [];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || trim($data[$field]) === '') {
            $missingFields[] = $field;
        }
    }

    if (!empty($missingFields)) {
        sendResponse('Error: Missing required fields', $missingFields);
    }

    // Validate email format
    if (!filter_var($data['senderEmail'], FILTER_VALIDATE_EMAIL)) {
        sendResponse('Error: Invalid email format');
    }

    // If phone number is provided, check if it's non-empty
    if (isset($data['senderPhone']) && trim($data['senderPhone']) === '') {
        sendResponse('Error: Phone number cannot be empty');
    }

    // Validate and format pickupTime
    $pickupTime = trim($data['pickupTime']);
    if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $pickupTime)) {
        sendResponse("Error: Invalid pickup time format. Please use 'Y-m-d H:i:s'. Example: 2024-12-11 14:30:00");
    }

    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $pickupTime);
    $errors = DateTime::getLastErrors();
    if ($errors['error_count'] > 0 || $errors['warning_count'] > 0 || !$dateTime) {
        sendResponse("Error: Invalid pickup time format. Please use 'Y-m-d H:i:s'. Example: 2024-12-11 14:30:00");
    }
    $pickupTime = $dateTime->format('Y-m-d H:i:s'); // Ensure valid format

    // Prepare SQL query
    $query = "
        UPDATE delivery_items SET 
            senderName = :senderName, 
            receiverName = :receiverName, 
            senderEmail = :senderEmail, 
            senderPhone = :senderPhone, 
            destination = :destination, 
            pickupTime = :pickupTime, 
            paymentType = :paymentType, 
            description = :description, 
            specificationDescription = :specificationDescription, 
            status = :status, 
            updated_at = NOW()
        WHERE id = :id
    ";

    // Prepare and execute the statement
    $stmt = $conn->prepare($query);
    $params = [
        ':id' => $data['id'],
        ':senderName' => trim($data['senderName']),
        ':receiverName' => trim($data['receiverName']),
        ':senderEmail' => trim($data['senderEmail']),
        ':senderPhone' => trim($data['senderPhone']),
        ':destination' => trim($data['destination']),
        ':pickupTime' => $pickupTime,
        ':paymentType' => trim($data['paymentType']),
        ':description' => trim($data['description']),
        ':specificationDescription' => trim($data['specificationDescription']),
        ':status' => isset($data['status']) ? $data['status'] : 'Pending'
    ];

    // Log the query and parameters before executing
    error_log("Executing SQL: " . $query);
    error_log("With parameters: " . print_r($params, true));

    if ($stmt->execute($params)) {
        sendResponse('Item updated successfully', null, 'success');
    } else {
        // Log the error information in case of failure
        $errorInfo = $stmt->errorInfo();
        error_log("Update Error: " . print_r($errorInfo, true)); // Log the error
        sendResponse('Error updating item', $errorInfo[2]);
    }

} catch (PDOException $e) {
    // Log any PDO-specific errors
    error_log("PDO Error: " . $e->getMessage());
    sendResponse('Database error', $e->getMessage());
} catch (Exception $e) {
    // Log any general errors
    error_log("General Error: " . $e->getMessage());
    sendResponse('Error', $e->getMessage());
}
?>