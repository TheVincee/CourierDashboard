
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

// SQL query to fetch items
$sql = "SELECT admin_items.*, riders.first_name 
        FROM admin_items 
        LEFT JOIN riders ON admin_items.rider_id = riders.id"; // Ensure correct join condition

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    echo json_encode(['status' => 'success', 'items' => $items]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No items found']);
}

$conn->close();
?>
