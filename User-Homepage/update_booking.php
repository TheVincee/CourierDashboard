<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "courier_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed']);
    exit;
}

// Get POST data
$bookingID = isset($_POST['bookingID']) ? intval($_POST['bookingID']) : 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$pickupAddress = isset($_POST['pickupAddress']) ? trim($_POST['pickupAddress']) : '';
$dropoffAddress = isset($_POST['dropoffAddress']) ? trim($_POST['dropoffAddress']) : '';
$pickupDistance = isset($_POST['pickupDistance']) ? floatval($_POST['pickupDistance']) : 0;
$dropoffDistance = isset($_POST['dropoffDistance']) ? floatval($_POST['dropoffDistance']) : 0;
$totalDistance = isset($_POST['totalDistance']) ? floatval($_POST['totalDistance']) : 0;

// Validate data
if ($bookingID <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid booking ID']);
    exit;
}

try {
    // Update query
    $sql = "UPDATE bookings SET 
            name = ?,
            phone = ?,
            pickupAddress = ?,
            dropoffAddress = ?,
            pickupDistance = ?,
            dropoffDistance = ?,
            totalDistance = ?
            WHERE bookingID = ?";
            
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Query preparation failed");
    }
    
    $stmt->bind_param("ssssdddi", 
        $name,
        $phone,
        $pickupAddress,
        $dropoffAddress,
        $pickupDistance,
        $dropoffDistance,
        $totalDistance,
        $bookingID
    );
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Booking updated successfully']);
    } else {
        throw new Exception("Failed to update booking");
    }
    
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} finally {
    if (isset($stmt)) $stmt->close();
    $conn->close();
}
?>