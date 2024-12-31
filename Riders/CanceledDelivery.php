<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancelled Deliveries</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Cancelled Deliveries</h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Sender Name</th>
                        <th>Tracking ID</th>
                        <th>Reason for Cancellation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="cancelledDeliveriesTable">
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
                    <h5 class="modal-title" id="viewModalLabel">View Delivery Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Sender Name -->
                        <div class="col-md-6">
                            <label for="viewSenderName" class="form-label">Sender Name</label>
                            <input type="text" class="form-control" id="viewSenderName" readonly>
                        </div>

                        <!-- Receiver Name -->
                        <div class="col-md-6">
                            <label for="viewReceiverName" class="form-label">Receiver Name</label>
                            <input type="text" class="form-control" id="viewReceiverName" readonly>
                        </div>

                        <!-- Sender Email -->
                        <div class="col-md-6">
                            <label for="viewSenderEmail" class="form-label">Sender Email</label>
                            <input type="email" class="form-control" id="viewSenderEmail" readonly>
                        </div>

                        <!-- Sender Phone -->
                        <div class="col-md-6">
                            <label for="viewSenderPhone" class="form-label">Sender Phone</label>
                            <input type="tel" class="form-control" id="viewSenderPhone" readonly>
                        </div>

                        <!-- Destination -->
                        <div class="col-md-6">
                            <label for="viewDestination" class="form-label">Destination</label>
                            <input type="text" class="form-control" id="viewDestination" readonly>
                        </div>

                        <!-- Pickup Time -->
                        <div class="col-md-6">
                            <label for="viewPickupTime" class="form-label">Pickup Time</label>
                            <input type="datetime-local" class="form-control" id="viewPickupTime" readonly>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label for="viewDescription" class="form-label">Description</label>
                            <input type="text" class="form-control" id="viewDescription" readonly>
                        </div>

                        <!-- Specification Description -->
                        <div class="col-md-12">
                            <label for="viewSpecificationDescription" class="form-label">Specification Description</label>
                            <textarea class="form-control" id="viewSpecificationDescription" rows="3" readonly></textarea>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="viewStatus" class="form-label">Status</label>
                            <input type="text" class="form-control" id="viewStatus" readonly>
                        </div>

                        <!-- Tracking ID -->
                        <div class="col-md-6">
                            <label for="viewTrackingID" class="form-label">Tracking ID</label>
                            <input type="text" class="form-control" id="viewTrackingID" readonly>
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
        // Load cancelled deliveries on page load
        loadCancelledDeliveries();

        function loadCancelledDeliveries() {
            $.ajax({
                url: 'fetchDeliveryitems.php', // Adjust to your server path
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success' && Array.isArray(response.data)) {
                        const tableRows = response.data.map(item => createTableRow(item)).join('');
                        $('#cancelledDeliveriesTable').html(tableRows); // Update the table body
                    } else {
                        alert(response.message || 'Failed to load cancelled deliveries.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error loading cancelled deliveries:', status, error);
                    alert('Error loading cancelled deliveries. Please check your connection and try again.');
                }
            });
        }

        function createTableRow(item) {
            return `
                <tr>
                    <td>${item.id}</td>
                    <td>${item.senderName}</td>
                    <td>${item.trackingID}</td>
                    <td>${item.cancellationReason}</td>
                    <td>
                        <button class="btn btn-sm btn-primary viewItemBtn" data-id="${item.id}">
                            <i class="fas fa-eye"></i> View
                        </button>
                    </td>
                </tr>`;
        }

        $(document).on('click', '.viewItemBtn', function () {
            const itemId = $(this).data('id'); // Retrieve the item ID from the button's data attribute

            // Debugging: Log the item ID
            console.log('Item ID:', itemId);

            // Clear previous modal fields to avoid showing outdated data
            $('#viewSenderName').val('');
            $('#viewReceiverName').val('');
            $('#viewSenderEmail').val('');
            $('#viewSenderPhone').val('');
            $('#viewDestination').val('');
            $('#viewPickupTime').val('');
            $('#viewDescription').val('');
            $('#viewSpecificationDescription').val('');
            $('#viewStatus').val('');
            $('#viewTrackingID').val('');

            // Start the AJAX request to fetch the delivery item details
            $.ajax({
                url: 'fetchDeliveryitems.php',
                method: 'GET',
                data: { id: itemId },
                dataType: 'json',
                success: function (response) {
                    console.log('Full Response:', response); // Log the full response for debugging

                    // Check if the response is valid and contains the necessary data
                    if (response.status === 'success' && response.data) {
                        const data = response.data; // Access the item data
                        console.log('Fetched Data:', data); // Log the fetched data for debugging

                        // Populate form fields with the fetched data
                        $('#viewSenderName').val(data.senderName);
                        $('#viewReceiverName').val(data.receiverName);
                        $('#viewSenderEmail').val(data.senderEmail);
                        $('#viewSenderPhone').val(data.senderPhone);
                        $('#viewDestination').val(data.destination);

                        // Handle pickupTime formatting (from 'YYYY-MM-DD HH:MM:SS' to 'YYYY-MM-DDTHH:MM')
                        const pickupTime = data.pickupTime ? data.pickupTime.replace(' ', 'T') : '';
                        $('#viewPickupTime').val(pickupTime);

                        $('#viewDescription').val(data.description);
                        $('#viewSpecificationDescription').val(data.specificationDescription);
                        $('#viewStatus').val(data.status || 'Pending'); // Ensure status is not empty
                        $('#viewTrackingID').val(data.trackingID);

                        // Show the modal for viewing the delivery item
                        $('#viewModal').modal('show');
                    } else {
                        alert(response.message || 'No delivery item details found.');
                    }
                },
                error: function (xhr, status, error) {
                    // Log AJAX error for debugging
                    console.error('AJAX Error:', { status, error, responseText: xhr.responseText });
                    alert('Error fetching delivery item details. Please try again.');
                }
            });
        });
    });
    </script>
</body>
</html>