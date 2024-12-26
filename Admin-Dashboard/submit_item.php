<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'courier_db');
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get form data with sanitization
$item_name = isset($_POST['item_name']) ? mysqli_real_escape_string($conn, $_POST['item_name']) : '';
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
$destination = isset($_POST['destination']) ? mysqli_real_escape_string($conn, $_POST['destination']) : '';
$item_load = isset($_POST['item_load']) ? (float)$_POST['item_load'] : 0;
$distance = isset($_POST['distance']) ? (float)$_POST['distance'] : 0;
$fuel_consumption_rate = isset($_POST['fuel_consumption_rate']) ? (float)$_POST['fuel_consumption_rate'] : 0;
$total_fuel_needed = isset($_POST['total_fuel_needed']) ? (float)$_POST['total_fuel_needed'] : 0;
$total_cost = isset($_POST['total_cost']) ? (float)$_POST['total_cost'] : 0;

// Ensure that the first name and rider ID are passed from the form or from a session
$first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($conn, $_POST['first_name']) : ''; // Changed from 'rider_name' to 'first_name'
$rider_id = isset($_POST['rider_id']) ? (int)$_POST['rider_id'] : 0;

// Validate inputs
if (empty($item_name) || empty($destination) || empty($first_name) || empty($rider_id)) {
    echo json_encode(['status' => 'error', 'message' => 'Required fields are missing']);
    exit;
}

// Prepare the SQL statement using prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO admin_items (item_name, quantity, destination, item_load, distance, fuel_consumption_rate, total_fuel_needed, total_cost, first_name, rider_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if ($stmt === false) {
    die(json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]));
}

// Bind parameters to the prepared statement
$stmt->bind_param('sssssdddsd', $item_name, $quantity, $destination, $item_load, $distance, $fuel_consumption_rate, $total_fuel_needed, $total_cost, $first_name, $rider_id); // Changed 'rider_name' to 'first_name'

// Execute the statement
if ($stmt->execute()) {
    $item_id = $stmt->insert_id; // Get the last inserted ID (auto-incremented item_id)
    
    // Return the response including the item_id and other details
    echo json_encode([
        'status' => 'success',
        'message' => 'Item added successfully',
        'item_id' => $item_id,
        'item_name' => $item_name,
        'quantity' => $quantity,
        'destination' => $destination,
        'item_load' => $item_load,
        'distance' => $distance,
        'fuel_consumption_rate' => $fuel_consumption_rate,
        'total_fuel_needed' => $total_fuel_needed,
        'total_cost' => $total_cost,
        'first_name' => $first_name, // Changed 'rider_name' to 'first_name'
        'rider_id' => $rider_id
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error adding item: ' . $stmt->error]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
