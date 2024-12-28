<?php
// filepath: /c:/xampp/htdocs/CourierDashboard/CourierDashboard/Riders/fetch_salaries.php

// Database connection details
$servername = "localhost";
$username = "root";  // your database username
$password = "";      // your database password
$dbname = "courier_db";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch salaries from the salaries_tb table
$sql = "SELECT * FROM salaries_tb";
$result = $conn->query($sql);

// Fetching the data and storing it in an array
$salaries = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $salaries[] = $row;  // store each salary record in the array
    }
} else {
    $salaries = []; // return an empty array if no records are found
}

// Close the connection
$conn->close();

// Return the salaries as JSON
echo json_encode($salaries);
?>
