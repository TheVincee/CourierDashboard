<?php
// Include database connection
include 'db.php';

$response = ['success' => false]; // Default response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $vehicleType = $_POST['vehicle_type'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate inputs (basic example)
    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($contact) && !empty($vehicleType) && !empty($username) && !empty($password)) {
        
        // Check if email or username already exists
        $checkStmt = $conn->prepare("SELECT * FROM riders WHERE email = ? OR username = ?");
        if ($checkStmt === false) {
            $response['error'] = 'Error in SQL statement preparation for checking duplicates: ' . $conn->error;
            echo json_encode($response);
            exit;
        }
        $checkStmt->bind_param("ss", $email, $username);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            $response['error'] = 'Email or Username already exists.';
            $checkStmt->close();
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Prepare SQL statement for inserting new rider
            $stmt = $conn->prepare("INSERT INTO riders (first_name, last_name, email, contact, vehicle_type, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
            
            // Check if the prepare() function returned false
            if ($stmt === false) {
                $response['error'] = 'Error in SQL statement preparation: ' . $conn->error;
                echo json_encode($response); // Output the error
                exit;
            }

            // Bind the parameters
            $stmt->bind_param("sssssss", $firstName, $lastName, $email, $contact, $vehicleType, $username, $hashedPassword);

            // Execute the statement
            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['error'] = 'Database insertion failed: ' . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
    } else {
        $response['error'] = 'Invalid input. Please fill out all required fields.';
    }
} else {
    $response['error'] = 'Invalid request method. Only POST is allowed.';
}

$conn->close();

// Return JSON response
echo json_encode($response);
?>
