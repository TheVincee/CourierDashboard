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

// Function to fetch all delivery items
function fetchAllDeliveryItems() {
    $pdo = getDbConnection();  // Get database connection

    // Query to fetch all delivery items
    $stmt = $pdo->prepare("SELECT * FROM delivery_items");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Return the fetched data
}

// Function to fetch delivery item by ID
function fetchDeliveryItemById($id) {
    $pdo = getDbConnection();  // Get database connection

    // Query to fetch details of a delivery item by ID
    $stmt = $pdo->prepare("SELECT * FROM delivery_items WHERE id = :id LIMIT 1");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);  // Bind the ID parameter securely

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);  // Return the fetched data
}

// Function to send error response
function sendErrorResponse($message) {
    echo json_encode([
        'status' => 'error',
        'message' => $message
    ]);
    exit;  // Exit after sending the response
}

// Check if the 'id' parameter is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);  // Secure the ID by converting it to an integer

    // Debugging: Log the received ID
    error_log("Received ID: $id");

    // Fetch the delivery item data
    $item = fetchDeliveryItemById($id);

    if ($item) {
        // Return a success response with the fetched data
        echo json_encode([
            'status' => 'success',
            'data' => $item
        ]);
    } else {
        // No item found with the provided ID
        error_log("No delivery item found with ID: $id");
        sendErrorResponse('No delivery item found with the given ID.');
    }
} else {
    // Fetch all delivery items
    $items = fetchAllDeliveryItems();

    if ($items) {
        // Return a success response with the fetched data
        echo json_encode([
            'status' => 'success',
            'data' => $items
        ]);
    } else {
        // No items found
        sendErrorResponse('No delivery items found.');
    }
}
?>