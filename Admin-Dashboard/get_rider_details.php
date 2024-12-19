<?php
// Include database connection
include 'db .php'; // Assuming you have a file for database connection

// Check if riderId is provided
if (isset($_GET['riderId']) && !empty($_GET['riderId'])) {
    $riderId = $_GET['riderId'];

    // Prepare SQL query to fetch rider details
    $sql = "SELECT first_name, last_name FROM riders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $riderId); // Bind the riderId parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a rider is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Return success and rider data
        echo json_encode([
            'success' => true,
            'firstName' => $row['first_name'],
            'lastName' => $row['last_name']
        ]);
    } else {
        // If no rider found, return an error message
        echo json_encode([
            'success' => false,
            'message' => 'Rider not found'
        ]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If riderId is not provided, return an error message
    echo json_encode([
        'success' => false,
        'message' => 'Rider ID is required'
    ]);
}
?>
