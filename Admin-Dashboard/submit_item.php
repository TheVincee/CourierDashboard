<?php
// Database connection
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "courier_db"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $itemName = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $destination = $_POST['destination'];
    $itemLoad = $_POST['item_load'];
    $distance = $_POST['distance'];
    $fuelConsumptionRate = $_POST['fuel_consumption_rate'];
    $totalFuelNeeded = $_POST['total_fuel_needed'];
    $totalCost = $_POST['total_cost'];
    $riderId = $_POST['rider_id']; // Assuming rider_id is passed in the form

    // Validate required fields
    if (empty($itemName) || empty($quantity) || empty($destination) || empty($itemLoad) || empty($distance) || empty($riderId)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Fetch first_name from the riders table using rider_id
    $riderCheckSql = "SELECT first_name FROM riders WHERE id = ?";
    $riderStmt = $conn->prepare($riderCheckSql);
    $riderStmt->bind_param("i", $riderId); // Assuming rider_id is an integer
    $riderStmt->execute();
    $riderStmt->store_result();

    if ($riderStmt->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid rider ID.']);
        $riderStmt->close();
        exit;
    }

    // Fetch the first_name from the result
    $riderStmt->bind_result($firstName);
    $riderStmt->fetch();
    $riderStmt->close();

    // SQL query to insert data into the items table
    $sql = "INSERT INTO admin_items (item_name, quantity, destination, item_load, distance, fuel_consumption_rate, total_fuel_needed, total_cost, rider_id, first_name) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sisdidddis",  // Adjusted to include rider_id and first_name
        $itemName,
        $quantity,
        $destination,
        $itemLoad,
        $distance,
        $fuelConsumptionRate,
        $totalFuelNeeded,
        $totalCost,
        $riderId,
        $firstName
    );

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Item added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding item: ' . $conn->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

$conn->close();
?>
