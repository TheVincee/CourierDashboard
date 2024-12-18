<?php
include 'db.php';

// Function to fetch filtered couriers from the database
function getFilteredCouriers($pdo, $vehicleType, $availability, $search) {
    $sql = "SELECT * FROM couriers WHERE 
            (:vehicleType = '' OR vehicle_type = :vehicleType) AND
            (:availability = '' OR availability = :availability) AND
            (name LIKE :search OR address LIKE :search)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':vehicleType', $vehicleType, PDO::PARAM_STR);
    $stmt->bindValue(':availability', $availability, PDO::PARAM_STR);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch couriers from the database
$stmt = $pdo->prepare("SELECT * FROM couriers");
$stmt->execute();
$couriers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle filtering and search
$vehicleTypeFilter = isset($_GET['vehicleType']) ? $_GET['vehicleType'] : '';
$availabilityFilter = isset($_GET['availability']) ? $_GET['availability'] : '';
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Apply filters only if any filter or search query is provided
if ($vehicleTypeFilter !== '' || $availabilityFilter !== '' || $searchQuery !== '') {
    $filteredCouriers = getFilteredCouriers($pdo, $vehicleTypeFilter, $availabilityFilter, $searchQuery);
} else {
    $filteredCouriers = $couriers;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Courier System</title>
    <style>
    body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 20px;
            margin: 0;
            padding: 0;
            background: url(city-blue-sky.jpg);
            opacity: 0.9;
            background-size: cover;
            background-repeat: no-repeat;
            border: 1px solid #544747;
            background-color: #f4f4f4;
            color: #333;
        }

        .filter-container {
            background-color: #3498db;
            color: #fff;
            top: 200px;
            padding: 5px 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            opacity: 0.8;
        }

        form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        label,
        select,
        input {
            margin-bottom: 10px;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
            color: #ecf0f1;
        }

        select {
            width: 150px;
            background-color: #ecf0f1;
        }

        input[type="text"] {
            width: 200px;
            background-color: #ecf0f1;
        }

        input[type="submit"] {
            background-color: #2980b9;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #1c6bd9;
        }

        .courier-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .courier-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            width: 300px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
        }

        .courier-card:hover {
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        }

        .courier-card h3 {
            color: #3498db;
            margin-bottom: 15px;
            font-size: 1.5em;
        }

        .availability-1 {
            border-color: #2ecc71;
        }

        .availability-0 {
            border-color: #e74c3c;
        }

        .package-delivery-btn,
        .book-ride-btn {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .package-delivery-btn:hover,
        .book-ride-btn:hover {
            background-color: #1c6bd9;
        }

        .button{
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;

        }
       
    </style>
   
</head>
<body>
<div class="hero">
<div class="filter-container">
    <form method="get" action="index.php">
<a href="LANDING.php" class="button">Button</a>
        <label for="vehicleType">Vehicle Type:</label>
        <select id="vehicleType" name="vehicleType">
            <option value="" <?php echo $vehicleTypeFilter === '' ? 'selected' : ''; ?>>All</option>
            <option value="Car" <?php echo $vehicleTypeFilter === 'Car' ? 'selected' : ''; ?>>Car</option>
            <option value="Motorcycle" <?php echo $vehicleTypeFilter === 'Motorcycle' ? 'selected' : ''; ?>>Motorcycle</option>
            <option value="Truck" <?php echo $vehicleTypeFilter === 'Truck' ? 'selected' : ''; ?>>Truck</option>
        </select>

        <label for="availability">Availability:</label>
        <select id="availability" name="availability">
            <option value="" <?php echo $availabilityFilter === '' ? 'selected' : ''; ?>>All</option>
            <option value="1" <?php echo $availabilityFilter === '1' ? 'selected' : ''; ?>>Available</option>
            <option value="0" <?php echo $availabilityFilter === '0' ? 'selected' : ''; ?>>Not Available</option>
        </select>

        <label for="search">Search:</label>
        <input type="text" id="search" name="search" value="<?php echo $searchQuery; ?>">

        <input type="submit" value="Filter">
    </form>
</div>

<div id="courierContainer" class="courier-container">
    <?php foreach ($filteredCouriers as $courier): ?>
        <div class="courier-card availability-<?php echo $courier['availability']; ?>">
            <h3><?php echo $courier['name']; ?></h3>
            <p>Vehicle Type: <?php echo $courier['vehicle_type']; ?></p>
            <p>Address: <?php echo $courier['address']; ?></p>
            <p>Availability: <?php echo $courier['availability'] ? 'Available' : 'Not Available'; ?></p>

            <!-- Package Delivery Button -->
            <button class="package-delivery-btn" onclick="openModal(<?php echo $courier['id']; ?>)">Package Delivery</button>

            <!-- Book a Ride Button -->
            <a href="ride_modal.php" class="book-ride-btn" onclick="openRideModal(<?php echo $courier['id']; ?>)">
    <span>Book a Ride</span>
   </a>
        </div>
    <?php endforeach; ?>
</div>

<!-- Placeholder for Modal Content -->
<div id="modalContainer"></div>

<script>
    // JavaScript function to open the Package Delivery modal
    function openPackageModal(courierId) {
        document.getElementById("packageModal").style.display = "block";
        document.getElementById("courierIdPackage").value = courierId;
    }

    // JavaScript function to open the Book a Ride modal
    function openRideModal(courierId) {
        document.getElementById("ride_modal").style.display = "block";
        document.getElementById("courierIdRide").value = courierId;
    }

    // JavaScript function to close the modals
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }
</script>

<!-- Include your other scripts here -->

<script>
    // JavaScript for Modal
    function openModal(courierId) {
        // Fetch the modal content using AJAX
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("modalContainer").innerHTML = this.responseText;
                document.getElementById("myModal").style.display = "block";
            }
        };

        xhttp.open("GET", "modal.php", true);
        xhttp.send();
    }

    // JavaScript function to close the modal
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
</script>


</div>
</body>
</html>
