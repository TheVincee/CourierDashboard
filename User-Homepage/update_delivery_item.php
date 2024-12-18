<?php
// Include your database connection
include 'db.php';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the raw POST data (for JSON request)
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if data is valid
    if (isset($data['id'])) {
        // Retrieve the data from the decoded JSON
        $id = $data['id'];
        $senderName = $data['senderName'];
        $receiverName = $data['receiverName'];
        $senderEmail = $data['senderEmail'];
        $senderPhone = $data['senderPhone'];
        $destination = $data['destination'];
        $pickupTime = $data['pickupTime'];
        $paymentType = $data['paymentType'];
        $description = $data['description'];
        $specificationDescription = $data['specificationDescription'];

        // Prepare the SQL query to update delivery item
        $query = "UPDATE delivery_items SET senderName = ?, receiverName = ?, senderEmail = ?, senderPhone = ?, destination = ?, pickupTime = ?, paymentType = ?, description = ?, specificationDescription = ? WHERE id = ?";
        $stmt = $conn->prepare($query);

        // Bind parameters and execute the query
        $stmt->bind_param("sssssssssi", $senderName, $receiverName, $senderEmail, $senderPhone, $destination, $pickupTime, $paymentType, $description, $specificationDescription, $id);

        if ($stmt->execute()) {
            // Return success response
            echo json_encode(["success" => true, "message" => "Delivery item updated successfully."]);
        } else {
            // Return error if failed
            echo json_encode(["error" => "Failed to update delivery item"]);
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(["error" => "ID not provided"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
