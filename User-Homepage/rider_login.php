<?php
header('Content-Type: application/json');

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'courier_db');

    // Check connection
    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
        exit;
    }

    // Retrieve data from POST request
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Query to fetch rider data
    $query = "SELECT * FROM riders WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $rider = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $rider['password'])) {
            // Successful login
            echo json_encode(['status' => 'success', 'message' => 'Login successful', 'data' => $rider]);
        } else {
            // Invalid password
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
        }
    } else {
        // Rider not found
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
