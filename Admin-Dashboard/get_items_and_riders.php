<?php
// Include database connection
include 'db.php'; // Ensure your database connection file is correct

// Initialize response array
$response = [
    'success' => false,
    'message' => 'An unknown error occurred',
    'riderData' => null,
    'adminItems' => []
];

// Debug: Log all incoming GET parameters
error_log('Incoming GET Parameters: ' . json_encode($_GET));

// Check if item_id is provided and valid
if (isset($_GET['itemId']) && ctype_digit($_GET['itemId'])) {
    $itemId = intval($_GET['itemId']); // Sanitize input as integer

    // Debug: Log sanitized itemId
    error_log('Sanitized itemId: ' . $itemId);

    // Query to fetch admin_items and rider data in one query using LEFT JOIN
    $sqlItems = "
        SELECT 
            ai.item_id,
            ai.item_name,
            ai.quantity,
            ai.destination,
            ai.item_load,
            ai.distance,
            ai.fuel_consumption_rate,
            ai.total_fuel_needed,
            ai.total_cost,
            ai.rider_id,
            r.first_name AS rider_first_name
        FROM admin_items ai
        LEFT JOIN riders r ON ai.rider_id = r.riders_id
        WHERE ai.item_id = ?
    ";

    if ($stmtItems = $conn->prepare($sqlItems)) {
        // Bind parameters and execute the query
        $stmtItems->bind_param("i", $itemId);
        $stmtItems->execute();
        $resultItems = $stmtItems->get_result();

        // Check if data is found
        if ($resultItems->num_rows > 0) {
            $adminItem = $resultItems->fetch_assoc();

            // Populate adminItems and riderData in response
            $response['adminItems'][] = $adminItem;
            $response['riderData'] = [
                'first_name' => $adminItem['rider_first_name'],
                'rider_id' => $adminItem['rider_id']
            ];

            // Set success message
            $response['success'] = true;
            $response['message'] = 'Data fetched successfully';
        } else {
            $response['message'] = 'No data found for the given Item ID';
        }

        $stmtItems->close();
    } else {
        $response['message'] = 'SQL preparation error for admin items: ' . $conn->error;
        error_log('SQL Error for Admin Items: ' . $conn->error);
    }
} else {
    $response['message'] = 'Item ID is required and must be a valid integer';
    error_log('Invalid or missing itemId parameter');
}

// Close the database connection
$conn->close();

// Set the header to indicate JSON response
header('Content-Type: application/json');

// Return response as JSON
echo json_encode($response);
?>
