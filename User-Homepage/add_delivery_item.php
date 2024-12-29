<?php
include('db.php');  // Ensure your DB connection is correct

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['senderName'], $data['receiverName'], $data['senderEmail'], $data['senderPhone'], $data['destination'], $data['pickupTime'], $data['paymentType'], $data['description'], $data['specificationDescription'])) {
    $senderName = $data['senderName'];
    $receiverName = $data['receiverName'];
    $senderEmail = $data['senderEmail'];
    $senderPhone = $data['senderPhone'];
    $destination = $data['destination'];
    $pickupTime = $data['pickupTime'];
    $paymentType = $data['paymentType'];
    $description = $data['description'];
    $specificationDescription = $data['specificationDescription'];
    $status = 'Pending'; // Default status

    // Insert the data into the database
    $query = "INSERT INTO delivery_items (senderName, receiverName, senderEmail, senderPhone, destination, pickupTime, paymentType, description, specificationDescription, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssss", $senderName, $receiverName, $senderEmail, $senderPhone, $destination, $pickupTime, $paymentType, $description, $specificationDescription, $status);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Item added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add item']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
}

$conn->close();
?>