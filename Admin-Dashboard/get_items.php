<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "courier_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Fetch items from database
$sql = "SELECT * FROM admin_items"; // Adjust your query accordingly
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $items = [];
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    echo json_encode(['success' => true, 'items' => $items]);
} else {
    echo json_encode(['success' => false, 'message' => 'No items found']);
}

$conn->close();
?>
