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

    // Check if data is received, if not, send an error response
    if (!$data) {
        sendResponse('Error: No data received');
    }

    // Validate required fields
    $requiredFields = [
        'senderName', 'receiverName', 'senderEmail', 'senderPhone',
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

    // Generate a unique tracking ID
    $trackingID = uniqid('TRK-', true);

    // Prepare SQL query
    $query = "
        INSERT INTO delivery_items 
        (
            senderName, receiverName, senderEmail, senderPhone, 
            destination, pickupTime, paymentType, description, specificationDescription, 
            status, created_at, updated_at, trackingID
        ) 
        VALUES 
        (
            :senderName, :receiverName, :senderEmail, :senderPhone, 
            :destination, :pickupTime, :paymentType, :description, :specificationDescription, 
            :status, NOW(), NOW(), :trackingID
        )
    ";

    // Prepare and execute the statement
    $stmt = $conn->prepare($query);
    $params = [
        ':senderName' => trim($data['senderName']),
        ':receiverName' => trim($data['receiverName']),
        ':senderEmail' => trim($data['senderEmail']),
        ':senderPhone' => trim($data['senderPhone']),
        ':destination' => trim($data['destination']),
        ':pickupTime' => $pickupTime,
        ':paymentType' => trim($data['paymentType']),
        ':description' => trim($data['description']),
        ':specificationDescription' => trim($data['specificationDescription']),
        ':status' => $data['status'] ?? 'Pending',  // Default to 'Pending' if status is not provided
        ':trackingID' => $trackingID
    ];

    // Execute the SQL statement
    if ($stmt->execute($params)) {
        sendResponse('Item added successfully', ['trackingID' => $trackingID]);
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
