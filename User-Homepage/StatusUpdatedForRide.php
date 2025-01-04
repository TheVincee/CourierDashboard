<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Details - Ready for Pickup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .table-responsive {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #495057;
            color: #ffffff;
            text-transform: uppercase;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .back-button {
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #343a40;
            text-align: center;
        }

        .btn-back {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="back-button">
            <button class="btn btn-back" onclick="window.history.back();">&larr; Back</button>
        </div>
        <h2>Ride Details - Ready for Pickup</h2>
        <div class="table-responsive">
            <table id="rideDetailsTable" class="table table-hover table-striped text-center align-middle">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Pickup Address</th>
                        <th>Dropoff Address</th>
                        <th>Pickup Distance</th>
                        <th>Dropoff Distance</th>
                        <th>Total Distance</th>
                        <th>Total Payable</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic data will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        // Initialize DataTable
        const table = $('#rideDetailsTable').DataTable({
            "processing": true,
            "serverSide": false,
            "ajax": {
                "url": "FetchStatus.php",
                "type": "GET",
                "dataSrc": function (json) {
                    if (json.status === 'success') {
                        return json.data;
                    } else {
                        alert(json.message || 'Failed to load ride details.');
                        return [];
                    }
                }
            },
            "columns": [
                { "data": "bookingID" },
                { "data": "name" },
                { "data": "phone" },
                { "data": "pickupAddress" },
                { "data": "dropoffAddress" },
                { "data": "pickupDistance" },
                { "data": "dropoffDistance" },
                { "data": "totalDistance" },
                { "data": "totalPayable" },
                { "data": "status" }
            ],
            "order": [[0, 'asc']],
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 10,
            "lengthMenu": [5, 10, 25, 50, 100],
            "language": {
                "emptyTable": "No ride details available"
            }
        });
    });
    </script>
</body>
</html>
