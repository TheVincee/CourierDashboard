<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Admin Items</h2>

        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addItemModal">
            Add Item
        </button>

        <!-- Table to display items -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
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
                <!-- Dynamic table rows will appear here after form submission -->
            </tbody>
        </table>
    </div>

    <!-- Modal for adding items -->
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add Item to Admin Items</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="itemForm" novalidate>
                        <div class="mb-3">
                            <label for="itemName" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="itemName" name="item_name" required placeholder="Enter item name">
                            <div class="invalid-feedback">Please enter a valid item name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required min="1" placeholder="Enter quantity">
                            <div class="invalid-feedback">Please enter a valid quantity (at least 1).</div>
                        </div>

                        <div class="mb-3">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" class="form-control" id="destination" name="destination" required placeholder="Enter destination">
                            <div class="invalid-feedback">Please enter a valid destination.</div>
                        </div>

                        <div class="mb-3">
                            <label for="itemLoad" class="form-label">Item Load (kg)</label>
                            <input type="number" class="form-control" id="itemLoad" name="item_load" required min="0" step="0.01" placeholder="Enter item load">
                            <div class="invalid-feedback">Please enter a valid load (at least 0).</div>
                        </div>

                        <div class="mb-3">
                            <label for="distance" class="form-label">Distance (km)</label>
                            <input type="number" class="form-control" id="distance" name="distance" required min="0" step="0.01" placeholder="Enter distance">
                            <div class="invalid-feedback">Please enter a valid distance (at least 0).</div>
                        </div>

                        <div class="mb-3">
                            <label for="fuelConsumptionRate" class="form-label">Fuel Consumption Rate (liters/10 km)</label>
                            <input type="number" class="form-control" id="fuelConsumptionRate" name="fuel_consumption_rate" value="1.0" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="totalFuelNeeded" class="form-label">Total Fuel Needed (liters)</label>
                            <input type="number" class="form-control" id="totalFuelNeeded" name="total_fuel_needed" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="totalCost" class="form-label">Total Cost (₱)</label>
                            <input type="number" class="form-control" id="totalCost" name="total_cost" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal for editing an item -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editItemForm" novalidate>
                        <!-- Form fields for editing item -->
                        <div class="mb-3">
                            <label for="editItemName" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="editItemName" name="item_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="editQuantity" name="quantity" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="editDestination" class="form-label">Destination</label>
                            <input type="text" class="form-control" id="editDestination" name="destination" required>
                        </div>
                        <div class="mb-3">
                            <label for="editItemLoad" class="form-label">Item Load (kg)</label>
                            <input type="number" class="form-control" id="editItemLoad" name="item_load" required min="0" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="editDistance" class="form-label">Distance (km)</label>
                            <input type="number" class="form-control" id="editDistance" name="distance" required min="0" step="0.01">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteItemModalLabel">Delete Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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

    const formData = $(this).serialize();

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
            if (response.success) {
                // Append new item to the table
                $('#itemTableBody').append(`
                    <tr data-id="${response.item_id}">
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
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.log("Server Response:", xhr.responseText);
            $('#result').html('<div class="alert alert-danger">Error submitting the form. Please try again.</div>');
        }
    });
});

// Fetch items from the server
function admin_items_fetch() {
    // Fetch request to get the items data
    fetch('get_items.php') // Replace with your endpoint to fetch the items data
        .then(response => response.json()) // Parse the JSON response
        .then(data => {
            if (data.success) {
                // Clear existing rows before appending new data
                $('#itemTableBody').empty();

                // Append each item as a new row in the table
                data.items.forEach(item => {
                    $('#itemTableBody').append(`
                        <tr data-id="${item.item_id}">
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
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            alert('Error fetching items. Please try again.');
        });
}

// Call the function when the page is loaded to populate the table
document.addEventListener('DOMContentLoaded', admin_items_fetch);

// Handle Edit button click event
$(document).on('click', '.btn-warning', function() {
    const row = $(this).closest('tr'); // Get the closest row
    const itemId = row.data('id'); // Assuming the item ID is stored in a data attribute

    // Set the current item ID in a global variable to use in the form submission
    currentItemId = itemId;

    // Fill the form fields with the current item details
    $('#editItemName').val(row.find('td').eq(0).text());
    $('#editQuantity').val(row.find('td').eq(1).text());
    $('#editDestination').val(row.find('td').eq(2).text());
    $('#editItemLoad').val(row.find('td').eq(3).text());
    $('#editDistance').val(row.find('td').eq(4).text());
    $('#editFuelConsumptionRate').val(row.find('td').eq(5).text());
    $('#editTotalFuelNeeded').val(row.find('td').eq(6).text());
    $('#editTotalCost').val(row.find('td').eq(7).text());

    // Open the edit modal
    $('#editItemModal').modal('show');
});

// Handle Edit Item Form submission
$('#editItemForm').submit(function(event) {
    event.preventDefault();

    // Validate form
    if (!this.checkValidity()) {
        this.classList.add('was-validated');
        return;
    }

    const formData = $(this).serialize(); // Get form data

    // Send AJAX request to update item
    $.ajax({
        url: 'edit_item.php', // Endpoint for editing an item
        type: 'POST',
        data: formData + `&id=${currentItemId}`, // Append item ID to form data
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Update the table with new item data
                admin_items_fetch();
                $('#editItemModal').modal('hide'); // Close the modal
                alert('Item updated successfully!');
            } else {
                alert('Error updating item.');
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert('Error submitting the form. Please try again.');
        }
    });
});

// Handle Delete button click event
$(document).on('click', '.btn-danger', function() {
    const row = $(this).closest('tr'); // Get the closest row
    const itemId = row.data('id'); // Assuming the item ID is stored in a data attribute

    // Confirm deletion
    if (confirm("Are you sure you want to delete this item?")) {
        $.ajax({
            url: 'delete_item.php', // Replace with your delete item endpoint
            type: 'POST',
            data: { id: itemId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Remove the item row from the table
                    row.remove();
                    alert('Item deleted successfully!');
                } else {
                    alert('Error deleting item.');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert('Error deleting the item. Please try again.');
            }
        });
    }
});

</script>

</body>
</html>
