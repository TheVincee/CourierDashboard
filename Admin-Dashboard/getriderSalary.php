<?php
// Include database configuration
$config = include('config.php');

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create a database connection
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Check if ridersId parameter is passed
if (isset($_GET['ridersId'])) {
    $ridersID = intval($_GET['ridersId']);

    if ($ridersID <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid rider ID provided.']);
        exit;
    }

    // Fetch rider details
    $stmt = $conn->prepare("SELECT * FROM riders WHERE riders_id = ? LIMIT 1");
    $stmt->bind_param("i", $ridersID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Rider not found with ID: ' . $ridersID]);
    } else {
        $rider = $result->fetch_assoc();
        echo json_encode(['success' => true, 'rider' => $rider]);
    }

    $stmt->close();
} else {
    // Fetch all riders
    $query = "SELECT riders_id, first_name, last_name FROM riders";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $riders = [];
        while ($row = $result->fetch_assoc()) {
            $riders[] = $row;
        }
        echo json_encode(['success' => true, 'riders' => $riders]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No riders found.']);
    }
}

// Close the database connection
$conn->close();
?>
