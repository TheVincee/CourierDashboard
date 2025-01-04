<?php
// Load database configuration
$config = include('config.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create connection
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Get rider ID from request
$riderID = isset($_GET['riderId']) ? intval($_GET['riderId']) : 0;

if ($riderID <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid rider ID provided.']);
    exit;
}

// Fetch rider salaries from the database
$salariesQuery = $conn->prepare("SELECT salarie_id, riders_id, first_name, last_name, items_delivered, distance_traveled, extra_miles, total_salary FROM salaries_tb WHERE riders_id = ?");
if (!$salariesQuery) {
    echo json_encode(['success' => false, 'message' => 'Prepare statement failed: ' . $conn->error]);
    exit;
}

$salariesQuery->bind_param("i", $riderID);
$salariesQuery->execute();
$salariesResult = $salariesQuery->get_result();

$salaries = [];
if ($salariesResult->num_rows > 0) {
    while ($row = $salariesResult->fetch_assoc()) {
        $salaries[] = $row;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No salaries found for this rider.']);
    $conn->close();
    exit;
}

$salariesQuery->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode(['success' => true, 'salaries' => $salaries]);

$conn->close();
?>