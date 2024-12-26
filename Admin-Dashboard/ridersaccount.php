<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Management</title>
    <link rel="stylesheet" href="RiderCSS.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <li><a href="AdminsDashboard.php"><i class="fas fa-home"></i>Home</a></li>
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

<div class="content">
    <div class="header">Animated Side Navigation Menu</div>
    <p>using only HTML and CSS</p>
</div>

<div class="container mt-5">
    <h2 class="mb-4">Rider Management</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRiderModal">
        Add New Rider
    </button>

    <!-- Riders Table -->
    <table class="table mt-4 table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Vehicle Type</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="ridersTableBody">
            <!-- Dynamic rows -->
        </tbody>
    </table>
</div>

<!-- Add Rider Modal -->
<div class="modal fade" id="addRiderModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Rider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addRiderForm">
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" id="firstName" placeholder="First Name" class="form-control" required>
                        </div>
                        <div class="col">
                            <input type="text" id="lastName" placeholder="Last Name" class="form-control" required>
                        </div>
                    </div>
                    <input type="email" id="email" placeholder="Email" class="form-control mb-3" required>
                    <input type="text" id="contact" placeholder="Contact" class="form-control mb-3" required>
                    <select id="vehicleType" class="form-select mb-3" required>
                        <option value="">Select Vehicle Type</option>
                        <option value="Motorcycle">Motorcycle</option>
                        <option value="Bicycle">Bicycle</option>
                        <option value="Car">Car</option>
                    </select>
                    <input type="text" id="username" placeholder="Username" class="form-control mb-3" required>
                    <input type="password" id="password" placeholder="Password" class="form-control mb-3" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveRiderBtn" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function () {
    // Fetch riders on page load
    fetchRiders();

    // Add new rider
    $('#saveRiderBtn').click(function (e) {
        e.preventDefault();  // Prevent form submission

        let formData = {
            first_name: $('#firstName').val(),
            last_name: $('#lastName').val(),
            email: $('#email').val(),
            contact: $('#contact').val(),
            vehicle_type: $('#vehicleType').val(),
            username: $('#username').val(),
            password: $('#password').val()
        };

        $.ajax({
            url: 'add_rider.php',  // Ensure the correct path to your PHP file
            method: 'POST',  // Use POST to send the data
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert('Rider added successfully.');
                    $('#addRiderModal').modal('hide');
                    fetchRiders();  // Reload riders data
                } else {
                    alert(response.error || 'Failed to add rider.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding rider.');
            }
        });
    });

    // Fetch riders from the server
    function fetchRiders() {
        $.ajax({
            url: 'fetch_riders.php',  // Ensure this is the correct path to fetch riders
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let tableBody = $('#ridersTableBody').empty();
                if (data.success && data.riders.length > 0) {
                    data.riders.forEach((rider, i) => {
                        tableBody.append(`
                            <tr>
                                <td>${i + 1}</td>
                                <td>${rider.first_name}</td>
                                <td>${rider.last_name}</td>
                                <td>${rider.email}</td>
                                <td>${rider.contact}</td>
                                <td>${rider.vehicle_type}</td>
                                <td>${rider.username}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="viewRider(${rider.riders_id})">View</button>
                                    <button class="btn btn-warning btn-sm" onclick="editRider(${rider.riders_id})">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteRider(${rider.riders_id})">Delete</button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    tableBody.append('<tr><td colspan="8" class="text-center">No riders found.</td></tr>');
                }
            },
            error: function () {
                alert('Failed to fetch rider data.');
            }
        });
    }

    // View rider details
    function viewRider(id) {
        $.ajax({
            url: 'fetch_rider.php',
            method: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                if (response.success && response.data) {
                    $('#viewRiderModal .modal-body').html(`
                        <p><strong>Rider ID:</strong> ${response.data.riders_id}</p>
                        <p><strong>Name:</strong> ${response.data.first_name} ${response.data.last_name}</p>
                        <p><strong>Email:</strong> ${response.data.email}</p>
                        <p><strong>Contact:</strong> ${response.data.contact}</p>
                        <p><strong>Username:</strong> ${response.data.username}</p>
                        <p><strong>Password:</strong> ${response.data.password}</p>
                        <p><strong>Role:</strong> ${response.data.role}</p>
                        <p><strong>Vehicle Type:</strong> ${response.data.vehicle_type}</p>
                        <p><strong>Created At:</strong> ${response.data.created_at}</p>
                    `);
                    $('#viewRiderModal').modal('show');
                } else {
                    alert('Rider not found.');
                }
            },
            error: function () {
                alert('Error fetching rider details.');
            }
        });
    }

    // Edit rider functionality (implement as needed)
    function editRider(id) {
        alert("Edit functionality not implemented yet for Rider ID: " + id);
    }

    // Delete rider function
    function deleteRider(id) {
        if (confirm('Are you sure you want to delete this rider?')) {
            $.ajax({
                url: 'delete_rider.php',
                method: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert('Rider deleted successfully.');
                        fetchRiders();  // Refresh the rider list
                    } else {
                        alert('Failed to delete rider.');
                    }
                },
                error: function () {
                    alert('Error deleting rider.');
                }
            });
        }
    }
});
</script>

</body>
</html>
