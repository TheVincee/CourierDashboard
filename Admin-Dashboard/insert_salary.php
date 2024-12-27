<?php
// Load database configuration
$config = include('config.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create connection
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Get POST data
$riderID = isset($_POST['riderId']) ? intval($_POST['riderId']) : 0;
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$itemsDelivered = isset($_POST['itemsDelivered']) ? intval($_POST['itemsDelivered']) : 0;
$distanceTraveled = isset($_POST['distanceTraveled']) ? floatval($_POST['distanceTraveled']) : 0;
$extraMiles = isset($_POST['extraMiles']) ? floatval($_POST['extraMiles']) : 0;
$totalSalary = isset($_POST['totalSalary']) ? floatval($_POST['totalSalary']) : 0;

if ($riderID <= 0 || empty($firstName) || empty($lastName) || $itemsDelivered < 0 || $distanceTraveled < 0 || $extraMiles < 0 || $totalSalary < 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    exit;
}

// Insert salary into salaries_tb
$insertSql = "INSERT INTO salaries_tb (riders_id, first_name, last_name, items_delivered, distance_traveled, extra_miles, total_salary) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insertSql);
$stmt->bind_param("issiiid", $riderID, $firstName, $lastName, $itemsDelivered, $distanceTraveled, $extraMiles, $totalSalary);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to insert salary data']);
}

$stmt->close();
$conn->close();
?>