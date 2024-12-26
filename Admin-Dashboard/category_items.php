<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                    <th>Rider first_Name</th>
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

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="itemForm" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label for="rider" class="form-label">Rider</label>
                                <select id="rider" class="form-select" name="id" required onchange="setRiderId(this)">
                                    <option value="" selected disabled>Choose a rider</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="rider_id" class="form-label">Rider ID</label>
                                <input type="text" id="rider_id" name="rider_id" class="form-control" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="itemName" class="form-label">Item Name</label>
                                <input type="text" class="form-control" id="itemName" name="item_name" required placeholder="Enter item name">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required min="1" placeholder="Enter quantity">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="destination" class="form-label">Destination</label>
                                <input type="text" class="form-control" id="destination" name="destination" required placeholder="Enter destination">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="itemLoad" class="form-label">Item Load (kg)</label>
                                <input type="number" class="form-control" id="itemLoad" name="item_load" required min="0" step="0.01" placeholder="Enter item load">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="distance" class="form-label">Distance (km)</label>
                                <input type="number" class="form-control" id="distance" name="distance" required min="0" step="0.01" placeholder="Enter distance" oninput="calculateFuelAndCost()">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fuelConsumptionRate" class="form-label">Fuel Consumption Rate</label>
                                <input type="number" class="form-control" id="fuelConsumptionRate" name="fuel_consumption_rate" value="1.0" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="totalFuelNeeded" class="form-label">Total Fuel Needed</label>
                                <input type="number" class="form-control" id="totalFuelNeeded" name="total_fuel_needed" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="totalCost" class="form-label">Total Cost (₱)</label>
                                <input type="number" class="form-control" id="totalCost" name="total_cost" readonly>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Item Modal -->
    <div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editItemForm">
                <div class="modal-body">
                    <input type="hidden" id="editItemId" name="item_id">
                    <div class="row g-3">
                        <!-- Item Name -->
                        <div class="col-md-6">
                            <label for="editItemName" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="editItemName" name="item_name" required>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-6">
                            <label for="editQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="editQuantity" name="quantity" required>
                        </div>

                        <!-- Destination -->
                        <div class="col-md-12">
                            <label for="editDestination" class="form-label">Destination</label>
                            <input type="text" class="form-control" id="editDestination" name="destination" required>
                        </div>

                        <!-- Item Load (kg) -->
                        <div class="col-md-6">
                            <label for="editItemLoad" class="form-label">Item Load (kg)</label>
                            <input type="number" class="form-control" id="editItemLoad" name="item_load" required min="0" step="0.01">
                        </div>

                        <!-- Distance (km) -->
                        <div class="col-md-6">
                            <label for="editDistance" class="form-label">Distance (km)</label>
                            <input type="number" class="form-control" id="editDistance" name="distance" required min="0" step="0.01" oninput="calculateFuelAndCost()">
                        </div>

                        <!-- Fuel Consumption Rate (liters/10 km) -->
                        <div class="col-md-6">
                            <label for="editFuelConsumptionRate" class="form-label">Fuel Consumption Rate</label>
                            <input type="number" class="form-control" id="editFuelConsumptionRate" name="fuel_consumption_rate" required readonly value="1.0">
                        </div>

                        <!-- Total Fuel Needed (liters) -->
                        <div class="col-md-6">
                            <label for="editTotalFuelNeeded" class="form-label">Total Fuel Needed</label>
                            <input type="number" class="form-control" id="editTotalFuelNeeded" name="total_fuel_needed" readonly>
                        </div>

                        <!-- Total Cost (₱) -->
                        <div class="col-md-6">
                            <label for="editTotalCost" class="form-label">Total Cost (₱)</label>
                            <input type="number" class="form-control" id="editTotalCost" name="total_cost" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function () {
    // Function to handle the selection of a rider
    function setRiderId(riderId) {
        console.log('Selected Rider ID:', riderId);
    }

    // Fetch items and riders to populate the table and dropdown
    $.ajax({
        url: 'get_items_and_riders.php', // PHP script to fetch items and riders
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            try {
                if (response && response.status === 'success') {
                    // Populate riders dropdown
                    if (response.riders) {
                        const riderSelect = $('#rider');
                        riderSelect.empty();
                        riderSelect.append('<option value="">Select Rider</option>');
                        response.riders.forEach((rider) => {
                            riderSelect.append(`
                                <option value="${rider.riders_id}" data-firstname="${rider.first_name}">
                                    ${rider.first_name}
                                </option>
                            `);
                        });
                    }

                    // Populate item table
                    if (response.items) {
                        const itemTableBody = $('#itemTableBody');
                        itemTableBody.empty();
                        response.items.forEach((item) => {
                            itemTableBody.append(`
                                <tr data-id="${item.item_id}">
                                    <td>${item.rider_first_name}</td>
                                    <td>${item.item_name}</td>
                                    <td>${item.quantity}</td>
                                    <td>${item.destination}</td>
                                    <td>${item.item_load}</td>
                                    <td>${item.distance}</td>
                                    <td>${item.fuel_consumption_rate}</td>
                                    <td>${item.total_fuel_needed}</td>
                                    <td>${item.total_cost}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm btn-edit" data-item-id="${item.item_id}">Edit</button>
                                        <button class="btn btn-danger btn-sm btn-delete" data-item-id="${item.item_id}">Delete</button>
                                    </td>
                                </tr>
                            `);
                        });
                    }
                } else {
                    console.error('Unexpected response format:', response);
                    alert('Failed to load data. Please try again later.');
                }
            } catch (error) {
                console.error('Error processing response:', error);
                alert('An error occurred while processing the data.');
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error, xhr.responseText);
            alert('An error occurred while loading the items.');
        },
    });

    // Handle Rider Selection Change
    $('#rider').on('change', function () {
        const riderId = $(this).val();
        if (riderId) {
            setRiderId(riderId);
        }
    });

    // Handle Edit Button Click
    $(document).on('click', '.btn-edit', function () {
        const itemId = $(this).data('item-id');
        const row = $(this).closest('tr');

        // Populate form with the current values
        $('#editItemId').val(itemId);
        $('#editItemName').val(row.find('td:nth-child(2)').text());
        $('#editQuantity').val(row.find('td:nth-child(3)').text());
        $('#editDestination').val(row.find('td:nth-child(4)').text());
        $('#editItemLoad').val(row.find('td:nth-child(5)').text());
        $('#editDistance').val(row.find('td:nth-child(6)').text());
        $('#editFuelConsumptionRate').val(row.find('td:nth-child(7)').text());
        $('#editTotalFuelNeeded').val(row.find('td:nth-child(8)').text());
        $('#editTotalCost').val(row.find('td:nth-child(9)').text());

        // Show the edit modal
        $('#editItemModal').modal('show');
    });

    // Handle Save Edit Item
    $('#editItemForm').on('submit', function (event) {
        event.preventDefault();

        const formData = {
            item_id: $('#editItemId').val(),
            item_name: $('#editItemName').val(),
            quantity: $('#editQuantity').val(),
            destination: $('#editDestination').val(),
            item_load: $('#editItemLoad').val(),
            distance: $('#editDistance').val(),
            fuel_consumption_rate: $('#editFuelConsumptionRate').val(),
        };

        // Calculate totals
        formData.total_fuel_needed = (formData.distance * formData.fuel_consumption_rate) / 10;
        formData.total_cost = formData.total_fuel_needed * 50; // Assume cost per liter is 50₱

        // Send update request
        $.ajax({
            url: 'update_item.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    alert('Item updated successfully.');
                    $('#editItemModal').modal('hide');
                    location.reload(); // Reload to refresh data
                } else {
                    alert('Failed to update item.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error updating item:', error);
                alert('An error occurred while updating the item.');
            },
        });
    });

    // Handle Delete Button Click
    $(document).on('click', '.btn-delete', function () {
        const itemId = $(this).data('item-id');

        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: 'delete_item.php',
                type: 'POST',
                data: { item_id: itemId },
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Item deleted successfully.');
                        location.reload();
                    } else {
                        alert('Failed to delete item.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error deleting item:', error);
                    alert('An error occurred while deleting the item.');
                },
            });
        }
    });

    // Handle Submit New Item
    $('#submitItemForm').on('submit', function (event) {
        event.preventDefault();

        const formData = {
            item_name: $('#newItemName').val(),
            quantity: $('#newQuantity').val(),
            destination: $('#newDestination').val(),
            item_load: $('#newItemLoad').val(),
            distance: $('#newDistance').val(),
            fuel_consumption_rate: $('#newFuelConsumptionRate').val(),
            rider_id: $('#rider').val(),
        };

        if (
            !formData.item_name ||
            !formData.quantity ||
            !formData.destination ||
            !formData.item_load ||
            !formData.distance ||
            !formData.fuel_consumption_rate ||
            !formData.rider_id
        ) {
            alert('Please fill all the fields.');
            return;
        }

        // Calculate totals
        formData.total_fuel_needed = (formData.distance * formData.fuel_consumption_rate) / 10;
        formData.total_cost = formData.total_fuel_needed * 50; // Assume cost per liter is 50₱

        $.ajax({
            url: 'submit_item.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    alert('Item added successfully.');
                    $('#submitItemModal').modal('hide');
                    location.reload();
                } else {
                    alert('Failed to add item.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error adding item:', error);
                alert('An error occurred while adding the item.');
            },
        });
    });
});


    </script>
</body>
</html>
