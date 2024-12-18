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

// Get form data
$item_name = $_POST['item_name'];
$quantity = $_POST['quantity'];
$destination = $_POST['destination'];
$item_load = $_POST['item_load'];
$distance = $_POST['distance'];
$fuel_consumption_rate = $_POST['fuel_consumption_rate'];
$total_fuel_needed = $_POST['total_fuel_needed'];
$total_cost = $_POST['total_cost'];

// Ensure that the first name is passed from the form or from a session
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';

// Insert data into the database
$sql = "INSERT INTO admin_items (item_name, quantity, destination, item_load, distance, fuel_consumption_rate, total_fuel_needed, total_cost, first_name) 
        VALUES ('$item_name', '$quantity', '$destination', '$item_load', '$distance', '$fuel_consumption_rate', '$total_fuel_needed', '$total_cost', '$first_name')";

if ($conn->query($sql) === TRUE) {
    $item_id = $conn->insert_id; // Get the last inserted ID
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
        'first_name' => $first_name // Include first name in the response
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error adding item: ' . $conn->error]);
}

$conn->close();
?>
