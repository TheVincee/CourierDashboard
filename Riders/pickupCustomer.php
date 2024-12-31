<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pickup Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Booked Rides</h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Pickup Address</th>
                        <th>Dropoff Address</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="bookedRidesTable">
                    <!-- Dynamic data will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>
 <!-- View Modal -->
 <div id="pickupReady" class="modal fade" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
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
        // Load booked rides on page load
        loadBookedRides();

        function loadBookedRides() {
            $.ajax({
                url: 'fetchBookings.php', // Adjust to your server path
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success' && Array.isArray(response.data)) {
                        const tableRows = response.data.map(item => createTableRow(item)).join('');
                        $('#bookedRidesTable').html(tableRows); // Update the table body
                    } else {
                        alert(response.message || 'Failed to load booked rides.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error loading booked rides:', status, error);
                    alert('Error loading booked rides. Please check your connection and try again.');
                }
            });
        }

        function createTableRow(item) {
            return `
                <tr>
                    <td>${item.bookingID}</td>
                    <td>${item.name}</td>
                    <td>${item.phone}</td>
                    <td>${item.pickupAddress}</td>
                    <td>${item.dropoffAddress}</td>
                    <td>${item.status}</td>
                    <td>
                        <button class="btn btn-sm btn-success pickupReady" data-id="${item.bookingID}">
                            Ready for Pickup
                        </button>
                    </td>
                </tr>`;
        }

        $(document).on('click', '.pickupReady', function () {
            const bookingID = $(this).data('id'); // Retrieve the booking ID from the button's data attribute

            // Debugging: Log the booking ID
            console.log('Booking ID:', bookingID);

            // Start the AJAX request to update the ride status
            $.ajax({
                url: 'updateStatusRide.php',
                method: 'POST',
                data: { bookingID: bookingID, status: 'Ready for Pickup' },
                dataType: 'json',
                success: function (response) {
                    console.log('Full Response:', response); // Log the full response for debugging

                    // Check if the response is valid and the status was updated
                    if (response.status === 'success') {
                        alert('Ride status updated successfully.');
                        loadBookedRides(); // Reload the booked rides to reflect the status change
                    } else {
                        alert(response.message || 'Failed to update ride status.');
                    }
                },
                error: function (xhr, status, error) {
                    // Log AJAX error for debugging
                    console.error('AJAX Error:', { status, error, responseText: xhr.responseText });
                    alert('Error updating ride status. Please try again.');
                }
            });
        });
    });
    </script>
</body>
</html>