<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'courier_db');
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Validate POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $category_name = $conn->real_escape_string(trim($_POST['category_name']));
    $description = $conn->real_escape_string(trim($_POST['description']));
    
    // Check if category name or description is empty
    if (empty($category_name) || empty($description)) {
        echo json_encode(['status' => 'error', 'message' => 'Category name and description are required.']);
        exit;
    }

    // Set the created_by field to a fixed admin ID (e.g., 1)
    $created_by = 1; // The admin user ID (fixed as 1)

    // Insert category into the admin_categories table
    $sql = "INSERT INTO admin_categories (category_name, description, created_by) 
            VALUES ('$category_name', '$description', $created_by)";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Category added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
    }

    // Close database connection
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
