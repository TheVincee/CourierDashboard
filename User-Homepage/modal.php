<?php
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Retrieve data from the form
        $courierId = $_POST['courierId'];
        $pickupLocation = $_POST['pickupLocation'];
        $deliveryDestination = $_POST['deliveryDestination'];
        $weight = $_POST['weight'];
        $productValue = $_POST['productValue'];
        $pickupDate = date('Y-m-d', strtotime($_POST['pickupDate']));

        // Insert data into the join table
        $stmt = $pdo->prepare("INSERT INTO courier_packages (courier_id, pickup_location, delivery_destination, weight, product_value, pickup_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$courierId, $pickupLocation, $deliveryDestination, $weight, $productValue, $pickupDate]);

        // Close the modal after submitting the form and display success message
        echo '<script>alert("Data inserted successfully!"); window.parent.closeModal(); window.parent.location.reload();</script>';
        exit();
    } catch (PDOException $e) {
        // Handle any database errors here
        echo "Error: " . $e->getMessage();
    }
}

// Fetch the courier ID from the query string
$courierId = isset($_GET['courierId']) ? $_GET['courierId'] : '';

// Fetch courier details for display
$stmtCourier = $pdo->prepare("SELECT * FROM couriers WHERE id = ?");
$stmtCourier->execute([$courierId]);
$courier = $stmtCourier->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Delivery</title>
    <link rel="stylesheet" href="Delivery.css">
    <style>
         body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .modal-content {
           color:black;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            width: 80%;
            max-width: 400px; /* Adjust max-width as needed */
            position: relative;
            margin: auto; /* Center horizontally */
        }

        .close-button {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .close-button:hover,
        .close-button:focus {
            color: #333;
        }

        h2 {
            color: #3498db;
            margin-top: 0;
        }

        label {
            color:black;
            display: block;
            margin: 10px 0;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #1c6bd9;
        }
    </style>
</head>
<body>

<div class="modal" id="myModal">

    <div class="modal-content">
    <span class="close-button" onclick="closeModal()">&times;</span>



        <form method="post" action="modal.php">
            <input type="hidden" name="courierId" value="<?php echo $courierId; ?>">

            <label for="pickupLocation">Pickup Location:</label>
            <input type="text" id="pickupLocation" name="pickupLocation" required>

            <label for="deliveryDestination">Delivery Destination:</label>
            <input type="text" id="deliveryDestination" name="deliveryDestination" required>

            <label for="weight">Quantity</label>
            <input type="text" id="weight" name="weight" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</div>
<script>
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
</script>

</body>
</html>
