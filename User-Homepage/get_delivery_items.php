<?php
header('Content-Type: application/json');

try {
    $conn = new mysqli('localhost', 'root', '', 'courier_db');

    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    $query = "SELECT * FROM delivery_items";
    $result = $conn->query($query);

    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    echo json_encode($items);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
