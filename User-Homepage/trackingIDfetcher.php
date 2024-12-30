<?php
header('Content-Type: application/json');

try {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'courier_db');
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    // Fetch all tracking information
    $query = "SELECT id, trackingID, description, receiverName, status, destination FROM delivery_items";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row; // Add each row to the data array
        }
        echo json_encode([
            'status_code' => 'SUCCESS',
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'status_code' => 'ERROR',
            'message' => 'No tracking information found'
        ]);
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode([
        'status_code' => 'ERROR',
        'message' => $e->getMessage()
    ]);
}
?>
