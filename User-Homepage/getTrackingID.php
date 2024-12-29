<?php
// Include the database connection
include('db.php');  // Ensure your DB connection is correct

// Check if the 'id' parameter is passed in the URL
if (isset($_GET['id'])) {
    // Get the item ID from the URL
    $itemId = $_GET['id'];

    // Prepare the SQL query to fetch the tracking ID from the database
    $query = "SELECT trackingID FROM delivery_items WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
        // Bind the item ID parameter to the SQL query
        $stmt->bind_param("i", $itemId);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Get the result from the executed query
            $result = $stmt->get_result();

            // Check if any rows are returned
            if ($result->num_rows > 0) {
                // Fetch the tracking ID from the result set
                $row = $result->fetch_assoc();
                // Return the tracking ID as JSON response
                echo json_encode(['status' => 'success', 'trackingID' => $row['trackingID']]);
            } else {
                // If no item is found, return an error
                echo json_encode(['status' => 'error', 'message' => 'Item not found']);
            }

            // Free the result set
            $result->free();
        } else {
            // If query execution fails, return an error and log the SQL error
            echo json_encode(['status' => 'error', 'message' => 'Failed to execute query', 'error' => $conn->error]);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If the statement preparation fails, return an error and log the SQL error
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the query', 'error' => $conn->error]);
    }
} else {
    // If the 'id' parameter is missing, return an error
    echo json_encode(['status' => 'error', 'message' => 'Missing item ID']);
}

// Close the database connection
$conn->close();
?>
