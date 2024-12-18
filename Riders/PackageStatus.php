<?php
header('Content-Type: application/json');

try {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'courier_db');

    // Check for connection error
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    // Handle GET request to fetch all delivery items
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $query = "SELECT * FROM delivery_items";
        $result = $conn->query($query);

        if ($result) {
            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            echo json_encode(['success' => true, 'packages' => $items]);
        } else {
            throw new Exception('Error fetching delivery items: ' . $conn->error);
        }

    // Handle POST request to update the delivery item status
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get data from POST request
        $itemId = isset($_POST['id']) ? (int) $_POST['id'] : null;
        $status = isset($_POST['status']) ? trim($_POST['status']) : null;

        // Validate required fields
        if ($itemId && $status) {
            // Valid status options
            $validStatuses = ['In Transit', 'Delivered'];

            // Check if the provided status is valid
            if (!in_array($status, $validStatuses)) {
                echo json_encode(['success' => false, 'message' => 'Invalid status value.']);
                exit;
            }

            // Prepare the SQL query to update the status
            $query = "UPDATE delivery_items SET status = ? WHERE id = ?";
            if ($stmt = $conn->prepare($query)) {
                // Debugging: Check if statement was prepared correctly
                if ($stmt === false) {
                    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
                    exit;
                }

                // Bind the parameters
                $bindResult = $stmt->bind_param("si", $status, $itemId);
                if (!$bindResult) {
                    echo json_encode(['success' => false, 'message' => 'Bind failed: ' . $stmt->error]);
                    exit;
                }

                $stmt->execute();

                // Check for successful update
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['success' => true, 'message' => 'Item status updated successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No changes were made or invalid item ID.']);
                }

                $stmt->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to prepare query: ' . $conn->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Missing required fields for updating.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    // Catch any exceptions and return error message
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
