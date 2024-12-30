<?php
include('db.php');  // Ensure your DB connection is correct

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

// Debug: Output the incoming data for inspection
error_log(print_r($data, true)); // This logs the incoming data to the error log

// Check if the required fields are present in the incoming data
if (isset($data['senderName'], $data['receiverName'], $data['senderEmail'], $data['senderPhone'], $data['destination'], $data['pickupTime'], $data['paymentType'], $data['description'], $data['specificationDescription'])) {

    // Assign data to variables
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

    // Prepare the SQL query to insert the data into the database
    $query = "INSERT INTO delivery_items (senderName, receiverName, senderEmail, senderPhone, destination, pickupTime, paymentType, description, specificationDescription, status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {

        // Bind the parameters to the query
        $stmt->bind_param("ssssssssss", $senderName, $receiverName, $senderEmail, $senderPhone, $destination, $pickupTime, $paymentType, $description, $specificationDescription, $status);

        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            // Successful insert
            echo json_encode(['status' => 'success', 'message' => 'Item added successfully']);
        } else {
            // Failed insert
            echo json_encode(['status' => 'error', 'message' => 'Failed to add item. Error: ' . $stmt->error]);
        }

        // Close the prepared statement
        $stmt->close();

    } else {
        // Prepare statement failed
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL statement']);
    }

} else {
    // Missing required input data
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
}

// Close the database connection
$conn->close();
?>
