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
$reason = isset($_POST['reason']) ? trim($_POST['reason']) : '';

if ($bookingID <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid booking ID']);
    exit;
}

try {
    // First fetch the booking details
    $fetchSql = "SELECT bookingID, name, phone, pickupAddress, dropoffAddress, 
                 pickupDistance, dropoffDistance, totalDistance, totalPayable, 
                 createdAt, status FROM bookings WHERE bookingID = ?";
    
    $fetchStmt = $conn->prepare($fetchSql);
    if (!$fetchStmt) {
        throw new Exception("Failed to prepare fetch query");
    }
    
    $fetchStmt->bind_param("i", $bookingID);
    $fetchStmt->execute();
    $result = $fetchStmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception("Booking not found");
    }
    
    $booking = $result->fetch_assoc();
    
    // Update booking status
    $updateSql = "UPDATE bookings SET 
                  status = 'cancelled',
                  cancellation_reason = ?,
                  cancelled_at = NOW()
                  WHERE bookingID = ?";
    
    $updateStmt = $conn->prepare($updateSql);
    if (!$updateStmt) {
        throw new Exception("Failed to prepare update query");
    }
    
    $updateStmt->bind_param("si", $reason, $bookingID);
    
    if ($updateStmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Booking cancelled successfully',
            'booking' => [
                'bookingID' => $booking['bookingID'],
                'name' => $booking['name'],
                'phone' => $booking['phone'],
                'pickupAddress' => $booking['pickupAddress'],
                'dropoffAddress' => $booking['dropoffAddress'],
                'pickupDistance' => $booking['pickupDistance'],
                'dropoffDistance' => $booking['dropoffDistance'],
                'totalDistance' => $booking['totalDistance'],
                'totalPayable' => $booking['totalPayable'],
                'createdAt' => $booking['createdAt'],
                'status' => 'cancelled',
                'cancellation_reason' => $reason,
                'cancelled_at' => date('Y-m-d H:i:s')
            ]
        ]);
    } else {
        throw new Exception("Failed to update booking status");
    }
    
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} finally {
    if (isset($fetchStmt)) $fetchStmt->close();
    if (isset($updateStmt)) $updateStmt->close();
    $conn->close();
}
?>