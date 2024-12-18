<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ob_start();
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'courier_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $e->getMessage()
    ]);
    exit;
}

if (isset($_POST['riderId'], $_POST['itemsDelivered'], $_POST['distanceTraveled'], $_POST['extraMiles'])) {
    $riderId = $_POST['riderId'];
    $itemsDelivered = (int)$_POST['itemsDelivered'];
    $distanceTraveled = (float)$_POST['distanceTraveled'];
    $extraMiles = (float)$_POST['extraMiles'];

    // Validate rider_id
    $riderCheckSql = "SELECT COUNT(*) FROM riders WHERE id = :riderId";
    $riderCheckStmt = $pdo->prepare($riderCheckSql);
    $riderCheckStmt->bindParam(':riderId', $riderId);
    $riderCheckStmt->execute();
    $riderExists = $riderCheckStmt->fetchColumn();

    if (!$riderExists) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid rider ID. No such rider exists.'
        ]);
        exit;
    }

    $baseSalary = 1000;
    $itemBonus = 10;
    $distanceBonus = 5;
    $extraBonus = 50;

    $totalSalary = $baseSalary + ($itemsDelivered * $itemBonus) + ($distanceTraveled * $distanceBonus) + ($extraMiles * $extraBonus);

    $sql = "INSERT INTO rider_salaries (rider_id, items_delivered, distance_traveled, extra_miles, total_salary) 
            VALUES (:riderId, :itemsDelivered, :distanceTraveled, :extraMiles, :totalSalary)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':riderId', $riderId);
    $stmt->bindParam(':itemsDelivered', $itemsDelivered);
    $stmt->bindParam(':distanceTraveled', $distanceTraveled);
    $stmt->bindParam(':extraMiles', $extraMiles);
    $stmt->bindParam(':totalSalary', $totalSalary);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Salary calculated and inserted successfully.',
            'totalSalary' => number_format($totalSalary, 2)
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error inserting salary data into the database.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Missing required parameters.'
    ]);
}

if (ob_get_length()) {
    ob_end_clean();
}
?>
