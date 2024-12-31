<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancelled Rides</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Cancelled Rides</h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Cancellation Reason</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="cancelledRidesTable">
                    <!-- Dynamic data will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal fade" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Cancelled Ride</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Booking ID -->
                        <div class="col-md-6">
                            <label for="viewBookingID" class="form-label">Booking ID</label>
                            <input type="text" class="form-control" id="viewBookingID" readonly>
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="viewName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="viewName" readonly>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label for="viewPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="viewPhone" readonly>
                        </div>

                        <!-- Pickup Address -->
                        <div class="col-md-6">
                            <label for="viewPickupAddress" class="form-label">Pickup Address</label>
                            <input type="text" class="form-control" id="viewPickupAddress" readonly>
                        </div>

                        <!-- Dropoff Address -->
                        <div class="col-md-6">
                            <label for="viewDropoffAddress" class="form-label">Dropoff Address</label>
                            <input type="text" class="form-control" id="viewDropoffAddress" readonly>
                        </div>

                        <!-- Pickup Distance -->
                        <div class="col-md-6">
                            <label for="viewPickupDistance" class="form-label">Pickup Distance</label>
                            <input type="text" class="form-control" id="viewPickupDistance" readonly>
                        </div>

                        <!-- Dropoff Distance -->
                        <div class="col-md-6">
                            <label for="viewDropoffDistance" class="form-label">Dropoff Distance</label>
                            <input type="text" class="form-control" id="viewDropoffDistance" readonly>
                        </div>

                        <!-- Total Distance -->
                        <div class="col-md-6">
                            <label for="viewTotalDistance" class="form-label">Total Distance</label>
                            <input type="text" class="form-control" id="viewTotalDistance" readonly>
                        </div>

                        <!-- Total Payable -->
                        <div class="col-md-6">
                            <label for="viewTotalPayable" class="form-label">Total Payable</label>
                            <input type="text" class="form-control" id="viewTotalPayable" readonly>
                        </div>

                        <!-- Created At -->
                        <div class="col-md-6">
                            <label for="viewCreatedAt" class="form-label">Created At</label>
                            <input type="text" class="form-control" id="viewCreatedAt" readonly>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="viewStatus" class="form-label">Status</label>
                            <input type="text" class="form-control" id="viewStatus" readonly>
                        </div>

                        <!-- Cancellation Reason -->
                        <div class="col-md-6">
                            <label for="viewCancellationReason" class="form-label">Cancellation Reason</label>
                            <input type="text" class="form-control" id="viewCancellationReason" readonly>
                        </div>

                        <!-- Cancelled At -->
                        <div class="col-md-6">
                            <label for="viewCancelledAt" class="form-label">Cancelled At</label>
                            <input type="text" class="form-control" id="viewCancelledAt" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        // Load cancelled rides on page load
        loadCancelledRides();

        function loadCancelledRides() {
            $.ajax({
                url: 'canceledRide.php', // Adjust to your server path
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success' && Array.isArray(response.data)) {
                        const tableRows = response.data.map(item => createTableRow(item)).join('');
                        $('#cancelledRidesTable').html(tableRows); // Update the table body
                    } else {
                        alert(response.message || 'Failed to load cancelled rides.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error loading cancelled rides:', status, error);
                    alert('Error loading cancelled rides. Please check your connection and try again.');
                }
            });
        }

        function createTableRow(item) {
            return `
                <tr>
                    <td>${item.bookingID}</td>
                    <td>${item.name}</td>
                    <td>${item.cancellation_reason}</td>
                    <td>${item.cancelled_at}</td>
                    <td>
                        <button class="btn btn-sm btn-primary viewRideBtn" data-id="${item.bookingID}">
                            <i class="fas fa-eye"></i> View
                        </button>
                    </td>
                </tr>`;
        }

        $(document).on('click', '.viewRideBtn', function () {
            const bookingID = $(this).data('id'); // Retrieve the booking ID from the button's data attribute

            // Debugging: Log the booking ID
            console.log('Booking ID:', bookingID);

            // Clear previous modal fields to avoid showing outdated data
            $('#viewBookingID').val('');
            $('#viewName').val('');
            $('#viewPhone').val('');
            $('#viewPickupAddress').val('');
            $('#viewDropoffAddress').val('');
            $('#viewPickupDistance').val('');
            $('#viewDropoffDistance').val('');
            $('#viewTotalDistance').val('');
            $('#viewTotalPayable').val('');
            $('#viewCreatedAt').val('');
            $('#viewStatus').val('');
            $('#viewCancellationReason').val('');
            $('#viewCancelledAt').val('');

            // Start the AJAX request to fetch the ride details
            $.ajax({
                url: 'viewCancelRide.php',
                method: 'GET',
                data: { bookingID: bookingID },
                dataType: 'json',
                success: function (response) {
                    console.log('Full Response:', response); // Log the full response for debugging

                    // Check if the response is valid and contains the necessary data
                    if (response.status === 'success' && response.data) {
                        const data = response.data; // Access the ride data
                        console.log('Fetched Data:', data); // Log the fetched data for debugging

                        // Populate form fields with the fetched data
                        $('#viewBookingID').val(data.bookingID);
                        $('#viewName').val(data.name);
                        $('#viewPhone').val(data.phone);
                        $('#viewPickupAddress').val(data.pickupAddress);
                        $('#viewDropoffAddress').val(data.dropoffAddress);
                        $('#viewPickupDistance').val(data.pickupDistance);
                        $('#viewDropoffDistance').val(data.dropoffDistance);
                        $('#viewTotalDistance').val(data.totalDistance);
                        $('#viewTotalPayable').val(data.totalPayable);
                        $('#viewCreatedAt').val(data.createdAt);
                        $('#viewStatus').val(data.status);
                        $('#viewCancellationReason').val(data.cancellation_reason);
                        $('#viewCancelledAt').val(data.cancelled_at);

                        // Show the modal for viewing the ride details
                        $('#viewModal').modal('show');
                    } else {
                        alert(response.message || 'No ride details found.');
                    }
                },
                error: function (xhr, status, error) {
                    // Log AJAX error for debugging
                    console.error('AJAX Error:', { status, error, responseText: xhr.responseText });
                    alert('Error fetching ride details. Please try again.');
                }
            });
        });
    });
    </script>
</body>
</html>