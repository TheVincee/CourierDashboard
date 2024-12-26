<?php
// Include database connection
include 'db.php';

// Initialize response
$response = ['success' => false, 'error' => '']; // Default response

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve POST data and sanitize them
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $vehicleType = trim($_POST['vehicle_type'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validate inputs
    if (empty($firstName) || empty($lastName) || empty($email) || empty($contact) || empty($vehicleType) || empty($username) || empty($password)) {
        $response['error'] = 'All fields are required.';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['error'] = 'Invalid email format.';
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Prepare SQL statement to insert the new rider
        $stmt = $conn->prepare("INSERT INTO riders (first_name, last_name, email, contact, vehicle_type, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstName, $lastName, $email, $contact, $vehicleType, $username, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Failed to insert the rider. Database error: ' . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }
} else {
    $response['error'] = 'Invalid request method. Only POST is allowed.';
}

// Close the database connection
$conn->close();

// Return the response as JSON
echo json_encode($response);
?>
