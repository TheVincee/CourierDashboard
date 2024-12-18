<?php
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Retrieve data from the form
        $courierId = $_POST['courierId'];
        $pickupLocation = $_POST['pickupLocation'];
        $destination = $_POST['destination'];
        $pickupTime = $_POST['pickupTime'];
        $pickupDate = date('Y-m-d', strtotime($_POST['pickupDate']));
        $timespan = $_POST['timespan'];

        // Insert data into the ride_bookings table
        $stmt = $pdo->prepare("
            INSERT INTO ride_bookings 
            (courier_id, pickup_location, destination, pickup_time, pickup_date, timespan) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$courierId, $pickupLocation, $destination, $pickupTime, $pickupDate, $timespan]);

        // Close the modal after submitting the form and display success message
        echo '<script>alert("Ride booked successfully!"); closeModal("rideModal");</script>';
        exit();
    } catch (PDOException $e) {
        // Handle any database errors here
        echo "Error: " . $e->getMessage();
    }
}

// Fetch the courier ID from the query string
$courierId = isset($_POST['courierId']) ? $_POST['courierId'] : '';

// Fetch courier details for display
$stmtCourier = $pdo->prepare("
    SELECT * FROM couriers 
    WHERE id = ?
");
$stmtCourier->execute([$courierId]);
$courier = $stmtCourier->fetch(PDO::FETCH_ASSOC);
?>

<h2>Book a Ride for Courier ID: <?php echo $courierId; ?></h2>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="booking.css">

    <title>Document</title>
</head>
<body>
<form>
<button onclick="goBack()" class="back-button"><span class="material-icons">arrow_back</span></button>

    <h2>Courier Booking Form</h2>

    <label for="senderName">Sender's Name:</label>
    <input type="text" id="senderName" name="senderName" required>

    <label for="senderAddress">Sender's Address:</label>
    <input type="text" id="senderAddress" name="senderAddress" required>

    <label for="receiverName">Receiver's Name:</label>
    <input type="text" id="receiverName" name="receiverName" required>

    <label for="receiverAddress">Receiver's Address:</label>
    <input type="text" id="receiverAddress" name="receiverAddress" required>

    <label for="packageType">Package Type:</label>
    <select id="packageType" name="packageType" required>
      <option value="document">Document</option>
      <option value="parcel">Parcel</option>
    </select>

    <label for="deliveryDate">Delivery Date:</label>
    <input type="date" id="deliveryDate" name="deliveryDate" required>

    <button type="submit">Book Courier</button>
  </form>
  <script>
        function goBack() {
            window.location.href = 'Index.php'; // Replace 'index.html' with the actual URL of your index page
        }
    </script>
</body>
</html>