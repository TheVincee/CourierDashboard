<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Admin Items</h2>

        <!-- Button to trigger Add Item Modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addItemModal">Add Item</button>

        <!-- Items Table -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Rider Name</th> <!-- Rider Name Column -->
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Destination</th>
                    <th>Item Load (kg)</th>
                    <th>Distance (km)</th>
                    <th>Fuel Consumption Rate (liters/10 km)</th>
                    <th>Total Fuel Needed (liters)</th>
                    <th>Total Cost (₱)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="itemTableBody">
                <!-- Dynamic Rows will be injected here -->
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="itemForm" novalidate>
                    <div class="row">
                        <!-- Rider Selection -->
                        <div class="col-md-6 mb-3">
                            <label for="rider" class="form-label">Rider</label>
                            <select id="rider" class="form-select" name="id" required>
                                <option value="" selected disabled>Choose a rider</option>
                                <?php
                                // Check if riders are available and populate the dropdown
                                if (isset($riders) && !empty($riders)) {
                                    foreach ($riders as $rider) {
                                        echo '<option value="' . htmlspecialchars($rider['id']) . '">' . htmlspecialchars($rider['first_name']) . '</option>';
                                    }
                                } else {
                                    echo '<option value="" disabled>No riders found</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Item Name -->
                        <div class="col-md-6 mb-3">
                            <label for="itemName" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="itemName" name="item_name" required placeholder="Enter item name">
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-6 mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required min="1" placeholder="Enter quantity">
                        </div>

                        <!-- Destination -->
                        <div class="col-md-6 mb-3">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" class="form-control" id="destination" name="destination" required placeholder="Enter destination">
                        </div>

                        <!-- Item Load -->
                        <div class="col-md-6 mb-3">
                            <label for="itemLoad" class="form-label">Item Load (kg)</label>
                            <input type="number" class="form-control" id="itemLoad" name="item_load" required min="0" step="0.01" placeholder="Enter item load">
                        </div>

                        <!-- Distance -->
                        <div class="col-md-6 mb-3">
                            <label for="distance" class="form-label">Distance (km)</label>
                            <input type="number" class="form-control" id="distance" name="distance" required min="0" step="0.01" placeholder="Enter distance" oninput="calculateFuelAndCost()">
                        </div>

                        <!-- Fuel Consumption Rate -->
                        <div class="col-md-6 mb-3">
                            <label for="fuelConsumptionRate" class="form-label">Fuel Consumption Rate</label>
                            <input type="number" class="form-control" id="fuelConsumptionRate" name="fuel_consumption_rate" value="1.0" readonly>
                        </div>

                        <!-- Total Fuel Needed -->
                        <div class="col-md-6 mb-3">
                            <label for="totalFuelNeeded" class="form-label">Total Fuel Needed</label>
                            <input type="number" class="form-control" id="totalFuelNeeded" name="total_fuel_needed" readonly>
                        </div>

                        <!-- Total Cost -->
                        <div class="col-md-6 mb-3">
                            <label for="totalCost" class="form-label">Total Cost (₱)</label>
                            <input type="number" class="form-control" id="totalCost" name="total_cost" readonly>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
  const fuelCostPerLiter = 75; // Define fuel cost per liter in pesos
const fuelConsumptionPer10Km = 1.0; // Predefined fuel consumption rate

// Calculate Fuel and Cost
function calculateFuelAndCost() {
    const distance = parseFloat($('#distance').val()) || 0;
    const load = parseFloat($('#itemLoad').val()) || 0;

    // Adjusted fuel rate based on weight
    const adjustedFuelRate = fuelConsumptionPer10Km + (load * 0.05);
    const totalFuel = (distance / 10) * adjustedFuelRate;
    const totalCost = totalFuel * fuelCostPerLiter;

    // Update fields
    $('#fuelConsumptionRate').val(adjustedFuelRate.toFixed(2));
    $('#totalFuelNeeded').val(totalFuel.toFixed(2));
    $('#totalCost').val(totalCost.toFixed(2));
}

// Trigger calculations on input change
$('#distance, #itemLoad').on('input', calculateFuelAndCost);

// Handle form submission
$('#itemForm').submit(function(event) {
    event.preventDefault();

    // Validate form
    if (!this.checkValidity()) {
        this.classList.add('was-validated');
        return;
    }

    const riderId = $('#rider').val(); // Get selected rider ID from the dropdown
    const riderName = $('#rider option:selected').text(); // Get rider's first name

    // Add rider_name to the form data
    const formData = $(this).serialize() + '&first_name=' + encodeURIComponent(riderName);

    $.ajax({
        url: 'submit_item.php', // Replace with your endpoint
        type: 'POST',
        data: formData,
        dataType: 'json', // Expect JSON response
        beforeSend: function () {
            console.log("Submitting form data:", formData);
            $('#result').html('<div class="alert alert-info">Submitting...</div>');
        },
        success: function(response) {
            console.log("Server Response:", response);
            try {
                if (response.status === 'success') {
                    // Append new item to the table
                    $('#itemTableBody').append(`
                        <tr data-id="${response.item_id}">
                            <td>${response.first_name}</td> <!-- Display Rider's First Name -->
                            <td>${response.item_name}</td>
                            <td>${response.quantity}</td>
                            <td>${response.destination}</td>
                            <td>${response.item_load}</td>
                            <td>${response.distance}</td>
                            <td>${response.fuel_consumption_rate}</td>
                            <td>${response.total_fuel_needed}</td>
                            <td>${response.total_cost}</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    `);

                    // Reset the form
                    $('#addItemModal').modal('hide');
                    $('#itemForm')[0].reset();
                    $('#itemForm').removeClass('was-validated');
                    $('#fuelConsumptionRate, #totalFuelNeeded, #totalCost').val('');
                } else {
                    alert(response.message || "Error adding item.");
                }
            } catch (e) {
                console.error("Error parsing response:", e);
                alert("Error processing server response.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            try {
                const response = JSON.parse(xhr.responseText);
                alert(response.message || "Error submitting the form. Please try again.");
            } catch (e) {
                alert("An unexpected error occurred. Please try again.");
            }
            $('#result').html('<div class="alert alert-danger">Error submitting the form. Please try again.</div>');
        }
    });
});

// Fetch items from the server
function admin_items_fetch() {
    fetch('get_items.php') // Replace with your correct endpoint
        .then(response => {
            if (!response.ok) {
                throw new Error(`Network response was not ok. Status: ${response.status}`);
            }
            return response.json(); // Parse JSON response
        })
        .then(data => {
            console.log('Data fetched:', data); // Log the fetched data to check the structure
            if (data.status === 'success') {
                $('#itemTableBody').empty(); // Clear existing rows

                data.items.forEach(item => {
                    $('#itemTableBody').append(`
                        <tr data-id="${item.item_id}">
                            <td>${item.first_name}</td> <!-- Display Rider's First Name -->
                            <td>${item.item_name}</td>
                            <td>${item.quantity}</td>
                            <td>${item.destination}</td>
                            <td>${item.item_load}</td>
                            <td>${item.distance}</td>
                            <td>${item.fuel_consumption_rate}</td>
                            <td>${item.total_fuel_needed}</td>
                            <td>${item.total_cost}</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    `);
                });
            } else {
                console.error("Failed to fetch items:", data.message);
                alert('Failed to fetch items');
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            alert('Error fetching items. Please try again.');
        });
}

// Call the function when the page is loaded to populate the table
document.addEventListener('DOMContentLoaded', admin_items_fetch);

// Fetch riders data for dropdown
fetch('fetchRiders.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const riderDropdown = document.getElementById('rider');
            data.riders.forEach(rider => {
                // Create an option element for each rider
                const option = document.createElement('option');
                option.value = rider.id; // Set the value as rider's ID
                option.textContent = rider.first_name; // Set the text as rider's first name
                riderDropdown.appendChild(option);
            });
        } else {
            // Handle error (No riders found)
            alert('No riders found');
        }
    })
    .catch(error => {
        console.error('Error fetching rider data:', error);
        alert('Error fetching rider data');
    });


</script>



</body>
</html>