<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "courier_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get tracking ID from a request (GET or POST)
$trackingID = $_GET['trackingID'] ?? null;

if ($trackingID) {
    // Fetch delivery item details
    $deliveryQuery = $mysqli->prepare("SELECT id, trackingID, senderName, receiverName, senderEmail, senderPhone, destination, pickupTime, paymentType, description, specificationDescription, status, riders_id FROM delivery_items WHERE trackingID = ?");
    $deliveryQuery->bind_param("s", $trackingID);
    $deliveryQuery->execute();
    $deliveryResult = $deliveryQuery->get_result();

    if ($deliveryResult->num_rows > 0) {
        $deliveryData = $deliveryResult->fetch_assoc();

        // Initialize rider information
        $riderName = "Not Assigned";
        $riderID = $deliveryData['riders_id'] ?? "None";

        // Check if a rider is assigned
        if (!empty($deliveryData['riders_id'])) {
            $riderID = $deliveryData['riders_id'];
            $riderQuery = $mysqli->prepare("SELECT riders_id, first_name, last_name FROM riders WHERE riders_id = ?");
            $riderQuery->bind_param("i", $riderID);
            $riderQuery->execute();
            $riderResult = $riderQuery->get_result();

            if ($riderResult->num_rows > 0) {
                $riderData = $riderResult->fetch_assoc();
                $riderName = $riderData['first_name'] . " " . $riderData['last_name'];
            }
            $riderQuery->close();
        }

        // Return data as JSON
        header('Content-Type: application/json');
        echo json_encode([
            'id' => $deliveryData['id'],
            'trackingID' => $deliveryData['trackingID'],
            'senderName' => $deliveryData['senderName'],
            'receiverName' => $deliveryData['receiverName'],
            'senderEmail' => $deliveryData['senderEmail'],
            'senderPhone' => $deliveryData['senderPhone'],
            'destination' => $deliveryData['destination'],
            'pickupTime' => $deliveryData['pickupTime'],
            'paymentType' => $deliveryData['paymentType'],
            'description' => $deliveryData['description'],
            'specificationDescription' => $deliveryData['specificationDescription'],
            'status' => $deliveryData['status'],
            'riderID' => $riderID,
            'riderName' => $riderName
        ]);

    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'No delivery found with tracking ID: ' . $trackingID]);
    }

    $deliveryQuery->close();
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Tracking ID is required.']);
}

$mysqli->close();
?>