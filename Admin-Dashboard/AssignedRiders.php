<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Riders</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .table-container {
            width: 90%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            padding: 20px;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
        }
        .table th {
            background-color: #4CAF50;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tr:hover {
            background-color: #ddd;
        }
        .form-control, .btn {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="table-container">
            <h2 class="mb-4">Assigned Riders</h2>
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Sender Name</th>
                        <th>Receiver Name</th>
                        <th>Sender Email</th>
                        <th>Sender Phone</th>
                        <th>Destination</th>
                        <th>Assigned</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    $mysqli = new mysqli("localhost", "root", "", "courier_db");

                    // Check connection
                    if ($mysqli->connect_error) {
                        die("Connection failed: " . $mysqli->connect_error);
                    }

                    // Fetch data from the database
                    $result = $mysqli->query("SELECT id, senderName, receiverName, senderEmail, senderPhone, destination, trackingID, assigned FROM delivery_items");

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['senderName']}</td>";
                            echo "<td>{$row['receiverName']}</td>";
                            echo "<td>{$row['senderEmail']}</td>";
                            echo "<td>{$row['senderPhone']}</td>";
                            echo "<td>{$row['destination']}</td>";
                            echo "<td>{$row['assigned']}</td>";
                            echo "<td>
                                    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#assignRiderModal' data-id='{$row['id']}'>
                                        Assign Rider
                                    </button>
                                    <button type='button' class='btn btn-info' data-toggle='modal' data-target='#viewDetailsModal' data-trackingid='{$row['trackingID']}'>
                                        View
                                    </button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No records found</td></tr>";
                    }

                    $mysqli->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Assign Rider Modal -->
    <div class="modal fade" id="assignRiderModal" tabindex="-1" aria-labelledby="assignRiderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignRiderModalLabel">Assign Rider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="assignRiderForm" action="assign_rider.php" method="POST">
                        <div class="form-group">
                            <label for="rider_id">Select Rider</label>
                            <select class="form-control" name="rider_id" id="rider_id">
                                <!-- Options will be populated by AJAX -->
                            </select>
                        </div>
                        <input type="hidden" name="order_id" id="order_id">
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDetailsModalLabel">View Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="view_id"></span></p>
                    <p><strong>Tracking ID:</strong> <span id="view_trackingID"></span></p>
                    <p><strong>Sender Name:</strong> <span id="view_senderName"></span></p>
                    <p><strong>Receiver Name:</strong> <span id="view_receiverName"></span></p>
                    <p><strong>Sender Email:</strong> <span id="view_senderEmail"></span></p>
                    <p><strong>Sender Phone:</strong> <span id="view_senderPhone"></span></p>
                    <p><strong>Destination:</strong> <span id="view_destination"></span></p>
                    <p><strong>Pickup Time:</strong> <span id="view_pickupTime"></span></p>
                    <p><strong>Payment Type:</strong> <span id="view_paymentType"></span></p>
                    <p><strong>Description:</strong> <span id="view_description"></span></p>
                    <p><strong>Specification:</strong> <span id="view_specificationDescription"></span></p>
                    <p><strong>Status:</strong> <span id="view_status"></span></p>
                    <p><strong>Rider ID:</strong> <span id="view_riderID"></span></p>
                    <p><strong>Rider Name:</strong> <span id="view_riderName"></span></p>
                </div>
            </div>
        </div>
    </div>

           <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#assignRiderModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var orderId = button.data('id');
            var modal = $(this);
            modal.find('#order_id').val(orderId);
    
            // Fetch riders from the database
            $.ajax({
                url: 'FetchRiderdev.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var riderSelect = modal.find('#rider_id');
                    riderSelect.empty();
                    riderSelect.append('<option value="">Select Rider</option>');
                    $.each(data, function(index, rider) {
                        riderSelect.append('<option value="' + rider.riders_id + '">' + rider.first_name + ' ' + rider.last_name + '</option>');
                    });
                },
                error: function() {
                    alert('Error fetching riders.');
                }
            });
        });
    
                                $('#viewDetailsModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var trackingID = button.data('trackingid');
                    var modal = $(this);
                
                    $.ajax({
                        url: 'fetchDeliveryRider.php',
                        type: 'GET',
                        data: { trackingID: trackingID },
                        dataType: 'json',
                        success: function(data) {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                modal.find('#view_id').text(data.id);
                                modal.find('#view_trackingID').text(data.trackingID);
                                modal.find('#view_senderName').text(data.senderName);
                                modal.find('#view_receiverName').text(data.receiverName);
                                modal.find('#view_senderEmail').text(data.senderEmail);
                                modal.find('#view_senderPhone').text(data.senderPhone);
                                modal.find('#view_destination').text(data.destination);
                                modal.find('#view_pickupTime').text(data.pickupTime);
                                modal.find('#view_paymentType').text(data.paymentType);
                                modal.find('#view_description').text(data.description);
                                modal.find('#view_specificationDescription').text(data.specificationDescription);
                                modal.find('#view_status').text(data.status);
                                modal.find('#view_riderID').text(data.riderID);
                                modal.find('#view_riderName').text(data.riderName);
                            }
                        },
                        error: function() {
                            alert('Error fetching delivery details.');
                        }
                    });
                });
    
        $('#assignRiderForm').on('submit', function(event) {
            event.preventDefault();
            var form = $(this);
            $.ajax({
                url: 'assigned_rider.php', // Ensure this URL matches the file path
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.success);
                        location.reload();
                    } else {
                        alert(response.error);
                    }
                },
                error: function() {
                    alert('Error assigning rider.');
                }
            });
        });
    
        // Manage aria-hidden and inert attributes for modals
        $('#viewDetailsModal').on('shown.bs.modal', function () {
            $(this).attr('aria-hidden', 'false').removeAttr('inert');
        });
    
        $('#viewDetailsModal').on('hidden.bs.modal', function () {
            $(this).attr('aria-hidden', 'true').attr('inert', '');
        });
    
        $('#assignRiderModal').on('shown.bs.modal', function () {
            $(this).attr('aria-hidden', 'false').removeAttr('inert');
        });
    
        $('#assignRiderModal').on('hidden.bs.modal', function () {
            $(this).attr('aria-hidden', 'true').attr('inert', '');
        });
    </script>
</body>
</html>