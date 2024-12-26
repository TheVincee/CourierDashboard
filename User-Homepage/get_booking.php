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
    
    // Get booking ID from request
    $bookingID = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    if ($bookingID <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid booking ID']);
        exit;
    }
    
    try {
        // Prepare and execute query
        $sql = "SELECT bookingID, name, phone, pickupAddress, dropoffAddress, 
                pickupDistance, dropoffDistance, totalDistance, totalPayable 
                FROM bookings WHERE bookingID = ?";
                
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Query preparation failed");
        }
        
        $stmt->bind_param("i", $bookingID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            throw new Exception("Booking not found");
        }
        
        // Fetch and return booking data
        $booking = $result->fetch_assoc();
        echo json_encode($booking);
        
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        if (isset($stmt)) $stmt->close();
        $conn->close();
    }
    ?>