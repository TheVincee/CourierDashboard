<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking ID Fetch Example</title>
    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (via CDN) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Track Your Delivery</h2>
        <button class="btn btn-primary" id="getTrackingBtn" data-item-id="123">Get Tracking ID</button>

        <!-- Displaying the tracking ID response -->
        <div id="trackingInfo" class="mt-3">
            <!-- This will be populated by JavaScript -->
        </div>
    </div>

    <!-- Bootstrap JavaScript (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Function to fetch tracking ID using jQuery and AJAX
        $('#getTrackingBtn').on('click', function() {
            const itemId = $(this).data('item-id'); // Get the item ID from the button's data attribute

            $.ajax({
                url: 'getTrackingID.php', // PHP file to fetch the tracking ID
                method: 'GET',
                data: { id: itemId }, // Send the item ID to the PHP script
                dataType: 'json', // Expect a JSON response
                success: function(response) {
                    const trackingInfoDiv = $('#trackingInfo');

                    if (response.status === 'success') {
                        // Create a success alert with the tracking ID
                        trackingInfoDiv.html(`
                            <div class="alert alert-success" role="alert">
                                Tracking ID: <strong>${response.trackingID}</strong>
                            </div>
                        `);
                    } else {
                        // Display error if no trackingID found
                        trackingInfoDiv.html(`
                            <div class="alert alert-danger" role="alert">
                                Error: ${response.message}
                            </div>
                        `);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    const trackingInfoDiv = $('#trackingInfo');
                    trackingInfoDiv.html(`
                        <div class="alert alert-danger" role="alert">
                            Failed to fetch the tracking ID. Please try again later.
                        </div>
                    `);
                }
            });
        });
    </script>
</body>
</html>
