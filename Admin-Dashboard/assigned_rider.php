<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "courier_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get order ID and rider ID from POST request
$orderID = $_POST['order_id'] ?? null;
$riderID = $_POST['rider_id'] ?? null;

if ($orderID && $riderID) {
    // Fetch rider details
    $riderQuery = $mysqli->prepare("SELECT first_name, last_name FROM riders WHERE riders_id = ?");
    $riderQuery->bind_param("i", $riderID);
    $riderQuery->execute();
    $riderResult = $riderQuery->get_result();

    if ($riderResult->num_rows > 0) {
        $riderData = $riderResult->fetch_assoc();
        $firstName = $riderData['first_name'];
        $lastName = $riderData['last_name'];

        // Update the delivery item with the assigned rider
        $updateQuery = $mysqli->prepare("UPDATE delivery_items SET riders_id = ?, assigned = 'Yes' WHERE id = ?");
        $updateQuery->bind_param("ii", $riderID, $orderID);
        if ($updateQuery->execute()) {
            echo json_encode(['success' => 'Rider assigned successfully.']);
        } else {
            echo json_encode(['error' => 'Error assigning rider.']);
        }
        $updateQuery->close();
    } else {
        echo json_encode(['error' => 'Rider not found.']);
    }
    $riderQuery->close();
} else {
    echo json_encode(['error' => 'Order ID and Rider ID are required.']);
}

$mysqli->close();
?>