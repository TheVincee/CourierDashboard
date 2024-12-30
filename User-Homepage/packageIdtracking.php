<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Deliveries</title>
    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (via CDN) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Track Your Deliveries</h2>

        <!-- Table to display the tracking information -->
        <table id="trackingTable" class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tracking ID</th>
                    <th scope="col">Description</th>
                    <th scope="col">Receiver Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Destination</th>
                </tr>
            </thead>
            <tbody>
                <!-- This will be populated by JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JavaScript (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Automatically fetch tracking information on page load
    $(document).ready(function() {
        // Perform AJAX request to fetch all tracking IDs
        $.ajax({
            url: 'trackingIDfetcher.php', // PHP file to fetch tracking data
            method: 'GET',
            dataType: 'json', // Expect a JSON response
            success: function(response) {
                const trackingTableBody = $('#trackingTable tbody');

                // Clear existing table rows
                trackingTableBody.empty();

                if (response.status_code === 'SUCCESS') {
                    // Iterate over all tracking data and add to table
                    response.data.forEach(item => {
                        trackingTableBody.append(`
                            <tr>
                                <td><strong>${item.id}</strong></td>
                                <td>${item.trackingID}</td>
                                <td>${item.description}</td>
                                <td>${item.receiverName}</td>
                                <td>${item.status}</td>
                                <td>${item.destination}</td>
                            </tr>
                        `);
                    });
                } else {
                    // Add error information to the table
                    trackingTableBody.html(`
                        <tr>
                            <td colspan="6" class="text-danger">
                                ${response.message}
                            </td>
                        </tr>
                    `);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                const trackingTableBody = $('#trackingTable tbody');
                trackingTableBody.html(`
                    <tr>
                        <td colspan="6" class="text-danger">
                            Failed to fetch the tracking information. Please try again later.
                        </td>
                    </tr>
                `);
            }
        });
    });
    </script>

</body>
</html>
