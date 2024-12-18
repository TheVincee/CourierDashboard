<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "courier_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Adjust the SQL query to fetch only the rider names
$sql = "SELECT id, first_name FROM riders"; // Fetch rider ID and first name

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    $riders = [];
    // Fetch all riders and their names
    while($row = $result->fetch_assoc()) {
        $riders[] = $row;
    }
    // Return the data as JSON
    echo json_encode(['success' => true, 'riders' => $riders]);
} else {
    // Return an error message if no riders are found
    echo json_encode(['success' => false, 'message' => 'No riders found']);
}

// Close the database connection
$conn->close();
?>
