<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'edit') {
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $vehicleType = $_POST['vehicle_type'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = $conn->prepare("UPDATE riders SET first_name = ?, last_name = ?, email = ?, contact = ?, vehicle_type = ?, username = ?, password = ? WHERE id = ?");
    if ($query->execute([$firstName, $lastName, $email, $contact, $vehicleType, $username, $password, $id])) {
        echo json_encode(["status" => "success", "message" => "Rider updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update rider!"]);
    }
}
?>
