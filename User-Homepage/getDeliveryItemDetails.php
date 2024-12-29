<?php
// Include your database connection
include 'db.php';

// Check if 'id' is provided and is a valid numeric value
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];  // Get the ID from the GET request

    // Prepare and execute your SQL query to fetch all items (if needed, you can still filter by ID)
    $query = "SELECT * FROM delivery_items WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
        // Bind parameters and execute the query
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch all the items as an associative array
                $items = [];
                while ($row = $result->fetch_assoc()) {
                    $items[] = $row;
                }
                echo json_encode(['success' => true, 'data' => $items]);
            } else {
                echo json_encode(['error' => 'No items found']);
            }
        } else {
            echo json_encode(['error' => 'SQL execution failed: ' . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['error' => 'SQL prepare failed: ' . $conn->error]);
    }
} else {
    // If no valid ID is provided, fetch all items
    $query = "SELECT * FROM delivery_items";

    if ($stmt = $conn->prepare($query)) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch all the items as an associative array
                $items = [];
                while ($row = $result->fetch_assoc()) {
                    $items[] = $row;
                }
                echo json_encode(['success' => true, 'data' => $items]);
            } else {
                echo json_encode(['error' => 'No items found']);
            }
        } else {
            echo json_encode(['error' => 'SQL execution failed: ' . $stmt->error]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['error' => 'SQL prepare failed: ' . $conn->error]);
    }
}

// Close the connection
$conn->close();
?>
