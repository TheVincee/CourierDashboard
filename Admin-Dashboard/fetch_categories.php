<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'courier_db');
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Fetch categories from the database
$sql = "SELECT id, category_name, description FROM admin_categories";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    echo json_encode(['status' => 'success', 'categories' => $categories]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No categories found.']);
}

// Close database connection
$conn->close();
?>
