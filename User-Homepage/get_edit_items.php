<?php
// Include your database connection
include 'db_connection.php';

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL query to fetch delivery item data
    $query = "SELECT * FROM delivery_items WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); // Bind the id as an integer

    // Execute the query and fetch the result
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();
        
        // Return the data as JSON
        echo json_encode($item);
    } else {
        // Error handling
        echo json_encode(["error" => "Failed to fetch data"]);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "ID not provided"]);
}
?>
