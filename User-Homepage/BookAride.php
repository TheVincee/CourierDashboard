<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Booking System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (needed for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Ride Booking System</h2>

    <!-- Button to open Add Booking modal -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#addBookingModal">Add Booking</button>

    <!-- Booking Table -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Pickup Address</th>
                <th>Drop-off Address</th>
                <th>Pickup Distance</th>
                <th>Drop-off Distance</th>
                <th>Total Distance</th>
                <th>Total Payable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="bookingTableBody">
            <!-- Rows will be populated via AJAX -->
        </tbody>
    </table>
</div>

<<!-- Modal for Add Booking -->
<div class="modal fade" id="addBookingModal" tabindex="-1" role="dialog" aria-labelledby="addBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBookingModalLabel">Add Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add Booking Form -->
                <form id="addBookingForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pickupAddress">Pickup Address</label>
                        <input type="text" class="form-control" id="pickupAddress" name="pickupAddress" required>
                    </div>
                    <div class="form-group">
                        <label for="dropoffAddress">Drop-off Address</label>
                        <input type="text" class="form-control" id="dropoffAddress" name="dropoffAddress" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pickupDistance">Pickup Distance (km)</label>
                            <input type="number" class="form-control" id="pickupDistance" name="pickupDistance" step="0.01" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dropoffDistance">Drop-off Distance (km)</label>
                            <input type="number" class="form-control" id="dropoffDistance" name="dropoffDistance" step="0.01" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="totalDistance">Total Distance (km)</label>
                        <input type="number" class="form-control" id="totalDistance" name="totalDistance" readonly>
                    </div>
                    <div class="form-group">
                        <label for="totalPayable">Total Payable (PHP)</label>
                        <input type="number" class="form-control" id="totalPayable" name="totalPayable" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Booking -->
<div class="modal fade" id="editBookingModal" tabindex="-1" role="dialog" aria-labelledby="editBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookingModalLabel">Edit Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editBookingForm" class="needs-validation" novalidate>
                    <input type="hidden" id="editBookingID" name="editBookingID">
                    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editName">Name</label>
                                <input type="text" class="form-control" id="editName" name="editName" required>
                                <div class="invalid-feedback">Please provide a name.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editPhone">Phone Number</label>
                                <input type="text" class="form-control" id="editPhone" name="editPhone" required>
                                <div class="invalid-feedback">Please provide a phone number.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="editPickupAddress">Pickup Address</label>
                                <input type="text" class="form-control" id="editPickupAddress" name="editPickupAddress" required>
                                <div class="invalid-feedback">Please provide pickup address.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="editDropoffAddress">Drop-off Address</label>
                                <input type="text" class="form-control" id="editDropoffAddress" name="editDropoffAddress" required>
                                <div class="invalid-feedback">Please provide drop-off address.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editPickupDistance">Pickup Distance (km)</label>
                                <input type="number" class="form-control" id="editPickupDistance" name="editPickupDistance" step="0.01" required>
                                <div class="invalid-feedback">Please provide pickup distance.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editDropoffDistance">Drop-off Distance (km)</label>
                                <input type="number" class="form-control" id="editDropoffDistance" name="editDropoffDistance" step="0.01" required>
                                <div class="invalid-feedback">Please provide drop-off distance.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="editTotalDistance">Total Distance (km)</label>
                                <input type="number" class="form-control" id="editTotalDistance" name="editTotalDistance" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Update Booking</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for View Booking -->
<div class="modal fade" id="viewBookingModal" tabindex="-1" role="dialog" aria-labelledby="viewBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewBookingModalLabel">View Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- View Booking Details (Grid Layout) -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-4"><strong>Booking ID:</strong></div>
                        <div class="col-md-8" id="viewBookingID"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Name:</strong></div>
                        <div class="col-md-8" id="viewName"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Phone:</strong></div>
                        <div class="col-md-8" id="viewPhone"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Pickup Address:</strong></div>
                        <div class="col-md-8" id="viewPickupAddress"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Drop-off Address:</strong></div>
                        <div class="col-md-8" id="viewDropoffAddress"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Pickup Distance:</strong></div>
                        <div class="col-md-8" id="viewPickupDistance"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Drop-off Distance:</strong></div>
                        <div class="col-md-8" id="viewDropoffDistance"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Total Distance:</strong></div>
                        <div class="col-md-8" id="viewTotalDistance"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Total Payment:</strong></div>
                        <div class="col-md-8" id="viewTotalPayable"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Status:</strong></div>
                        <div class="col-md-8" id="viewStatus"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Cancellation Reason:</strong></div>
                        <div class="col-md-8" id="viewCancellationReason"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Button -->

.php
<!-- Cancel Booking Modal -->
<div class="modal fade" id="cancelBookingModal" tabindex="-1" role="dialog" aria-labelledby="cancelBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelBookingModalLabel">Cancel Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cancelBookingForm">
                    <div class="form-group">
                        <label for="bookingID">Booking ID</label>
                        <input type="text" class="form-control" id="bookingID" readonly>
                    </div>
                    <div class="form-group">
                        <label for="cancelReason">Cancellation Reason</label>
                        <textarea class="form-control" id="cancelReason" rows="3" required></textarea>
                    </div>
                    <button type="button" class="btn btn-danger" id="confirmCancelButton">Yes, Cancel Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS & jQuery -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    // Function to load bookings from the server and calculate payment
// Load bookings and calculate the total payment
function loadBookings() {
    $.ajax({
        url: 'gets_bookings.php', // Get bookings from the server
        type: 'GET',
        success: function(response) {
            var bookings = JSON.parse(response); // Parse the response as an array
            var bookingRows = '';

            if (bookings.length === 0) {
                // If no bookings are found, show a "No bookings available" message
                bookingRows = '<tr><td colspan="10" class="text-center">No bookings available</td></tr>';
            } else {
                // Iterate over each booking and calculate the total payment
                bookings.forEach(function(booking) {
                    // Calculate total distance by adding pickup and dropoff distances
                    var pickupDistance = parseFloat(booking.pickupDistance) || 0;
                    var dropoffDistance = parseFloat(booking.dropoffDistance) || 0;
                    var totalDistance = pickupDistance + dropoffDistance;

                    // Calculate the payment based on total distance
                    var ratePerKm = 10; // Rate per km in pesos (change as needed)
                    var totalPayment = totalDistance * ratePerKm;

                    // Create a new table row for each booking
                    bookingRows += `
                        <tr>
                            <td>${booking.bookingID}</td>
                            <td>${booking.name}</td>
                            <td>${booking.phone}</td>
                            <td>${booking.pickupAddress}</td>
                            <td>${booking.dropoffAddress}</td>
                            <td>${pickupDistance} km</td>
                            <td>${dropoffDistance} km</td>
                            <td>${totalDistance.toFixed(2)} km</td>
                            <td>₱${totalPayment.toFixed(2)}</td> <!-- Display total payment -->
                            <td>
                                <button onclick="viewBooking(${booking.bookingID})" class="btn btn-info">View</button>
                                <button onclick="editBooking(${booking.bookingID})" class="btn btn-warning">Edit</button>
                                <button onclick="cancelBooking(${booking.bookingID})" class="btn btn-danger" data-toggle="modal" data-target="#cancelBookingModal">Cancel</button>
                            </td>
                        </tr>
                    `;
                });
            }

            // Update the booking table body with the generated rows or the "No bookings" message
            $('#bookingTableBody').html(bookingRows);
        },
        error: function() {
            alert('Failed to load bookings. Please try again later.');
        }
    });
}


// Load bookings when the page loads
$(document).ready(function() {
    loadBookings();
});

// Calculate payment based on pickup and drop-off distance
function calculatePayment() {
    // Get pickup and dropoff distances from the input fields, defaulting to 0 if empty or invalid
    var pickupDistance = parseFloat($('#pickupDistance').val()) || 0;
    var dropoffDistance = parseFloat($('#dropoffDistance').val()) || 0;

    // Assuming the rate per kilometer is 10 pesos
    var ratePerKm = 10;

    // Calculate total distance by adding pickup and dropoff distances
    var totalDistance = pickupDistance + dropoffDistance;

    // Calculate the total payment by multiplying total distance with rate per km
    var totalPayment = totalDistance * ratePerKm;

    // Update the UI fields to show the total distance and total payment
    $('#totalDistance').val(totalDistance.toFixed(2)); // Show the total distance in kilometers
    $('#totalPayable').val(totalPayment.toFixed(2));   // Show the total payment in pesos
}

// Trigger the payment calculation whenever pickup or dropoff distances are updated
$('#pickupDistance, #dropoffDistance').on('input', function() {
    calculatePayment();
});

// Add booking form submit event
$('#addBookingForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting the traditional way

        // Get form data
        var name = $('#name').val();
        var phone = $('#phone').val();
        var pickupAddress = $('#pickupAddress').val();
        var dropoffAddress = $('#dropoffAddress').val();
        var pickupDistance = $('#pickupDistance').val();
        var dropoffDistance = $('#dropoffDistance').val();
        var totalAmount = $('#totalPayable').val(); // Assuming total is pre-calculated

        // Validate form fields
        if (!name || !phone || !pickupAddress || !dropoffAddress || !pickupDistance || !dropoffDistance || !totalAmount) {
            alert("All fields are required!");
            return;
        }

        // Send AJAX request to insert the booking into the database
        $.ajax({
            url: 'add_booking.php',
            type: 'POST',
            data: {
                name: name,
                phone: phone,
                pickupAddress: pickupAddress,
                dropoffAddress: dropoffAddress,
                pickupDistance: pickupDistance,
                dropoffDistance: dropoffDistance,
                totalAmount: totalAmount
            },
            success: function(response) {
                try {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert("Booking added successfully!");
                        // Optionally, you can reset the form or redirect the user
                        $('#addBookingForm')[0].reset();
                    } else {
                        alert("Failed to add booking: " + result.message);
                    }
                } catch (e) {
                    console.error("Invalid JSON response:", response);
                    alert("An error occurred while processing the booking.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", status, error);
                alert("An error occurred while adding the booking.");
            }
        });
    });
// Function to edit booking
function editBooking(bookingID) {
    $.ajax({
        url: 'get_booking.php',
        type: 'GET',
        data: { id: bookingID },
        success: function(response) {
            try {
                var booking = JSON.parse(response);
                if (booking) {
                    $('#editBookingID').val(booking.bookingID);
                    $('#editName').val(booking.name);
                    $('#editPhone').val(booking.phone);
                    $('#editPickupAddress').val(booking.pickupAddress);
                    $('#editDropoffAddress').val(booking.dropoffAddress);
                    $('#editPickupDistance').val(booking.pickupDistance);
                    $('#editDropoffDistance').val(booking.dropoffDistance);
                    
                    // Calculate total distance
                    var totalDistance = (parseFloat(booking.pickupDistance) || 0) + 
                                      (parseFloat(booking.dropoffDistance) || 0);
                    $('#editTotalDistance').val(totalDistance.toFixed(2));
                    
                    $('#editBookingModal').modal('show');
                }
            } catch (e) {
                console.error("Error parsing booking data:", e);
                alert('Error loading booking details');
            }
        },
        error: function() {
            alert('Failed to load booking details');
        }
    });
}

// Auto-calculate total distance
$('#editPickupDistance, #editDropoffDistance').on('input', function() {
    var pickupDistance = parseFloat($('#editPickupDistance').val()) || 0;
    var dropoffDistance = parseFloat($('#editDropoffDistance').val()) || 0;
    var totalDistance = pickupDistance + dropoffDistance;
    $('#editTotalDistance').val(totalDistance.toFixed(2));
});

// Handle form submission
$('#editBookingForm').on('submit', function(e) {
    e.preventDefault();
    
    if (!this.checkValidity()) {
        e.stopPropagation();
        $(this).addClass('was-validated');
        return;
    }
    
    const formData = {
        bookingID: $('#editBookingID').val(),
        name: $('#editName').val(),
        phone: $('#editPhone').val(),
        pickupAddress: $('#editPickupAddress').val(),
        dropoffAddress: $('#editDropoffAddress').val(),
        pickupDistance: $('#editPickupDistance').val(),
        dropoffDistance: $('#editDropoffDistance').val(),
        totalDistance: $('#editTotalDistance').val()
    };

    $.ajax({
        url: 'update_booking.php',
        type: 'POST',
        data: formData,
        beforeSend: function() {
            $('button[type="submit"]').prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...'
            );
        },
        success: function(response) {
            try {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    $('#editBookingModal').modal('hide');
                    alert('Booking updated successfully');
                    loadBookings(); // Refresh bookings table
                } else {
                    alert('Failed to update booking: ' + result.message);
                }
            } catch (e) {
                console.error("Error processing response:", e);
                alert('Error updating booking');
            }
        },
        error: function() {
            alert('Failed to update booking');
        },
        complete: function() {
            $('button[type="submit"]').prop('disabled', false).text('Update Booking');
        }
    });
});

// View booking details
// View booking details
function viewBooking(bookingID) {
    // Show loading state
    $('#viewBookingDetails').html('<div class="text-center"><div class="spinner-border" role="status"></div></div>');
    $('#viewBookingModal').modal('show');

    $.ajax({
        url: 'viewBooking.php',
        type: 'GET',
        data: { bookingID: bookingID },
        dataType: 'json',
        success: function(response) {
            try {
                if (response.status === 'error') {
                    throw new Error(response.message);
                }

                const booking = response.data;
                $('#viewBookingID').text(booking.bookingID);
                $('#viewName').text(booking.name);
                $('#viewPhone').text(booking.phone);
                $('#viewPickupAddress').text(booking.pickupAddress);
                $('#viewDropoffAddress').text(booking.dropoffAddress);
                $('#viewPickupDistance').text(`${parseFloat(booking.pickupDistance).toFixed(2)} km`);
                $('#viewDropoffDistance').text(`${parseFloat(booking.dropoffDistance).toFixed(2)} km`);
                $('#viewTotalDistance').text(`${parseFloat(booking.totalDistance).toFixed(2)} km`);
                
                if (booking.totalPayable) {
                    $('#viewTotalPayable').text(`₱${parseFloat(booking.totalPayable.replace(/,/g, '')).toFixed(2)}`);
                } else {
                    $('#viewTotalPayable').text('N/A');
                }
                
                $('#viewStatus').text(booking.status);
                $('#viewCancellationReason').text(booking.cancellation_reason);
            } catch (e) {
                console.error('Error processing booking:', e);
                $('#viewBookingDetails').html(`
                    <div class="alert alert-danger">
                        Error loading booking details: ${e.message}
                    </div>
                `);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', {xhr, status, error});
            $('#viewBookingDetails').html(`
                <div class="alert alert-danger">
                    Failed to load booking details. Please try again.
                </div>
            `);
        }
    });
}
// Function to show the cancel booking modal
function cancelBooking(bookingID) {
    // Reset form and set bookingID
    $('#cancelBookingForm')[0].reset();
    $('#bookingID').val(bookingID);
    $('#cancelBookingModal').modal('show');
}

// Confirm Cancel Button Click Event
$('#confirmCancelButton').on('click', function () {
    const bookingID = $('#bookingID').val();
    const cancellationReason = $('#cancelReason').val();

    // Validate inputs
    if (!bookingID) {
        alert('Invalid booking ID');
        return;
    }

    if (!cancellationReason.trim()) {
        alert('Please provide a cancellation reason.');
        return;
    }

    // Disable button and show loading state
    const $btn = $(this);
    $btn.prop('disabled', true).text('Cancelling...');

    $.ajax({
        url: 'cancel_booking.php',
        type: 'POST',
        dataType: 'json',
        data: {
            bookingID: bookingID,
            reason: cancellationReason
        },
        success: function (response) {
            console.log('Cancel response:', response);
            if (response.status === 'success') {
                // Clear form and close modal
                $('#cancelBookingForm')[0].reset();
                $('#cancelBookingModal').modal('hide');
                
                // Show success message
                alert('Booking cancelled successfully');
                
                // Refresh bookings table
                loadBookings();
            } else {
                alert('Failed to cancel booking: ' + (response.message || 'Unknown error'));
            }
        },
        error: function (xhr, status, error) {
            console.error('Cancel booking error:', {xhr, status, error});
            alert('Failed to cancel booking. Please try again.');
        },
        complete: function() {
            // Reset button state
            $btn.prop('disabled', false).text('Yes, Cancel Booking');
        }
    });
});

</script>
</body>
</html>
