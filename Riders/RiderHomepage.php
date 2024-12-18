<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Dashboard</title>
    <link rel="stylesheet" href="RiderCSS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="wrapper">
    <input type="checkbox" id="btn" hidden>
    <label for="btn" class="menu-btn">
        <i class="fas fa-bars"></i>
        <i class="fas fa-times"></i>
    </label>
    <nav id="sidebar">
        <div class="title">Side Menu</div>
        <ul class="list-items">
            <li><a href="Home.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="#"><i class="fas fa-sliders-h"></i>Clients</a></li>
            <li><a href="#"><i class="fas fa-address-book"></i>Services</a></li>
            <li><a href="#"><i class="fas fa-cog"></i>Settings</a></li>
            <li><a href="#"><i class="fas fa-stream"></i>Features</a></li>
            <li><a href="#"><i class="fas fa-user"></i>About us</a></li>
            <li><a href="#"><i class="fas fa-globe-asia"></i>Languages</a></li>
            <li><a href="#"><i class="fas fa-envelope"></i>Contact us</a></li>
            <div class="icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </ul>
    </nav>
</div>

<div class="container mt-5">
    <h1 class="text-center mb-4">Rider Dashboard</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Package Description</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Destination Address</th>
                    <th>Contact Number</th>
                    <th>Payment Type</th>
                    <th>Status</th>
                    <th>Rider Delivering</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="packageTable">
                <!-- Package rows will be dynamically populated -->
            </tbody>
        </table>
    </div>
</div>

<!-- Pickup Modal -->
<div class="modal fade" id="pickupModal" tabindex="-1" aria-labelledby="pickupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pickupModalLabel">Package Pickup</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="pickupForm">
                    <div class="mb-3">
                        <label for="packageId" class="form-label">Package ID</label>
                        <input type="text" class="form-control" id="packageId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="packageDescription" class="form-label">Package Description</label>
                        <input type="text" class="form-control" id="packageDescription" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="receiverName" class="form-label">Receiver</label>
                        <input type="text" class="form-control" id="receiverName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status">
                            <option value="In Transit">In Transit</option>
                            <option value="Delivered">Delivered</option>
                            <!-- Add other status options here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-success" id="updateStatusBtn">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Function to load packages into the table
function loadPackages() {
    $.ajax({
        url: 'PackageStatus.php',  // PHP script for fetching data
        type: 'GET',
        success: function (data) {
            if (data.success && Array.isArray(data.packages)) {
                const tableBody = $("#packageTable");
                tableBody.empty(); // Clear existing rows

                data.packages.forEach((pkg, index) => {
                    const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${pkg.description}</td>
                            <td>${pkg.senderName}</td>
                            <td>${pkg.receiverName}</td>
                            <td>${pkg.destination}</td>
                            <td>${pkg.senderPhone}</td>
                            <td>${pkg.paymentType}</td>
                            <td>${pkg.status}</td>
                            <td>${pkg.rider || "Not Assigned"}</td>
                            <td>
                                <button class="btn btn-success btn-sm pickup-btn" 
                                        data-id="${pkg.id}" 
                                        data-description="${pkg.description}" 
                                        data-receiver="${pkg.receiverName}">
                                    Pickup
                                </button>
                            </td>
                        </tr>
                    `;
                    tableBody.append(row);
                });
            } else {
                alert('Error fetching data: ' + (data.message || 'No packages available.'));
            }
        },
        error: function () {
            alert("Error fetching data. Please try again.");
        }
    });
}

// Event listener for the "Pickup" button click inside the table
$(document).on("click", ".pickup-btn", function () {
    const packageId = $(this).data("id");
    const description = $(this).data("description");
    const receiver = $(this).data("receiver");

    // Display the modal and populate it with the package details
    $("#pickupModal").modal('show');
    $("#packageDescription").val(description);
    $("#receiverName").val(receiver);
    $("#packageId").val(packageId);

    // Optionally, you can populate the rider dropdown dynamically if you want to let the admin select a rider
    // This could involve an additional AJAX call to fetch available riders if necessary
});

// Event listener for the "Update Status" button inside the modal
$(document).on("click", "#updateStatusBtn", function () {
    const packageId = $("#packageId").val();  // Get the package ID from the hidden input
    const status = $("#status").val();  // Get the selected status from the dropdown
    const currentRider = "Rider John";  // Assume this is the logged-in rider (could be dynamic)

    // Basic validation to ensure package ID and status are not empty
    if (!packageId || !status) {
        alert("Please fill in all required fields.");
        return;
    }

    // Send update request to the backend
    $.ajax({
        url: 'PackageStatus.php',  // PHP script for updating the package status
        type: 'POST',
        data: {
            id: packageId,
            status: status,
            rider: currentRider
        },
        success: function (response) {
            if (response.success) {
                alert(response.message);
                $("#pickupModal").modal('hide');  // Close the modal
                loadPackages(); // Reload the package list after updating
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert("Error updating package status. Please try again.");
        }
    });
});

// Initial load of packages when page loads
$(document).ready(function() {
    loadPackages(); // Load the package list
});

</script>

</body>
</html>
