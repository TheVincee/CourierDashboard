<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'courier_db');
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Check if required fields are set in $_POST
$requiredFields = ['fullName', 'email', 'phone', 'location', 'aboutMe', 'newPassword', 'confirmPassword'];
foreach ($requiredFields as $field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        echo json_encode(['status' => 'error', 'message' => "Field '$field' is required."]);
        exit;
    }
}

// Ensure the new password matches the confirmation
if ($_POST['newPassword'] !== $_POST['confirmPassword']) {
    echo json_encode(['status' => 'error', 'message' => 'Passwords do not match.']);
    exit;
}

// Collect form data and sanitize input
$fullName = $conn->real_escape_string($_POST['fullName']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$location = $conn->real_escape_string($_POST['location']);
$aboutMe = $conn->real_escape_string($_POST['aboutMe']);
$password = password_hash($_POST['newPassword'], PASSWORD_BCRYPT); // Hash new password
$profile_picture = 'default_picture.png'; // Default picture path

// Handle profile picture upload if available
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $targetDir = "profiles/"; // Path to your profile picture folder
    $fileName = basename($_FILES['profile_picture']['name']);
    $targetFilePath = $targetDir . uniqid() . "_" . $fileName;

    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
        $profile_picture = $targetFilePath;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error uploading profile picture.']);
        exit;
    }
}

// Insert profile data into database
$sql = "INSERT INTO profile_user (fullName, email, phone, location, aboutMe, password, profile_picture) VALUES ('$fullName', '$email', '$phone', '$location', '$aboutMe', '$password', '$profile_picture')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Profile created successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error creating profile: ' . $conn->error]);
}

$conn->close();
?>
