<?php
// Include your database connection
include 'db.php';

// Function to fetch delivery items
function fetchDeliveryItems($conn, $id = null) {
    if ($id !== null) {
        // Query to fetch item by ID
        $query = "SELECT * FROM delivery_items WHERE id = ?";
    } else {
        // Query to fetch all items
        $query = "SELECT * FROM delivery_items";
    }

    // Prepare and execute the SQL query
    if ($stmt = $conn->prepare($query)) {
        if ($id !== null) {
            // Bind parameter if fetching a specific item
            $stmt->bind_param("i", $id);
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch all items as an associative array
                $items = [];
                while ($row = $result->fetch_assoc()) {
                    $items[] = $row;
                }
                return ['status' => 'success', 'data' => $items]; // Ensuring consistent success response format
            } else {
                return ['status' => 'error', 'message' => 'No items found']; // Consistent error format
            }
        } else {
            return ['status' => 'error', 'message' => 'SQL execution failed: ' . $stmt->error]; // Detailed error message
        }

        // Close the statement
        $stmt->close();
    } else {
        return ['status' => 'error', 'message' => 'SQL prepare failed: ' . $conn->error]; // Detailed error message
    }
}

// Check if 'id' is provided and is a valid numeric value
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];  // Get the ID from the GET request
    $response = fetchDeliveryItems($conn, $id);
} else {
    // If no valid ID is provided, fetch all items
    $response = fetchDeliveryItems($conn);
}

// Output the response as JSON
header('Content-Type: application/json'); // Set content type to application/json
echo json_encode($response);

// Close the connection
$conn->close();
?>
