<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Delivery Management</title>
  <link rel="stylesheet" href="Sidebard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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

  <div class="container my-5">
    <div class="card shadow-lg">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <span>Delivery Items</span>
          <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addItemModal">
            <i class="fas fa-plus"></i> Add Booking
          </button>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-hover table-striped text-center align-middle">
            <thead class="table-dark">
              <tr>
    <th>Package ID</th>
    <th>Sender</th>
    <th>Receiver</th>
    <th>Destination</th>
    <th>Pickup Time</th>
    <th>Description</th>
    <th>Payment Type</th>
    <th>Status</th>
    <th>Specification Description</th>
    <th>Email</th> <!-- Add Email column header -->
    <th>Phone</th> <!-- Add Phone column header -->
    <th>Actions</th>

              </tr>
            </thead>
            <tbody id="deliveryItemsTable">
              <!-- Dynamic data will be loaded here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

 <!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addItemModalLabel">Add Item for Delivery</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addDeliveryItemForm">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="senderName" class="form-label">Sender Name</label>
              <input type="text" class="form-control" id="senderName" name="senderName" placeholder="Enter sender's name" required>
            </div>
            <div class="col-md-6">
              <label for="receiverName" class="form-label">Receiver Name</label>
              <input type="text" class="form-control" id="receiverName" name="receiverName" placeholder="Enter receiver's name" required>
            </div>
            <div class="col-md-6">
              <label for="senderEmail" class="form-label">Sender Email</label>
              <input type="email" class="form-control" id="senderEmail" name="senderEmail" placeholder="Enter sender's email" required>
            </div>
            <div class="col-md-6">
              <label for="senderPhone" class="form-label">Sender Phone Number</label>
              <input type="tel" class="form-control" id="senderPhone" name="senderPhone" placeholder="Enter sender's phone number" required>
            </div>
            <div class="col-md-12">
              <label for="destination" class="form-label">Destination</label>
              <input type="text" class="form-control" id="destination" name="destination" placeholder="Enter destination" required>
            </div>
            <div class="col-md-6">
              <label for="pickupTime" class="form-label">Pickup Time</label>
              <input type="datetime-local" class="form-control" id="pickupTime" name="pickupTime" required>
            </div>
            <div class="col-md-6">
              <label for="paymentType" class="form-label">Payment Type</label>
              <select class="form-select" id="paymentType" name="paymentType" required>
                <option value="" disabled selected>Select Payment Type</option>
                <option value="Cash">Cash</option>
                <option value="Card">Card</option>
                <option value="Online">Online Payment</option>
              </select>
            </div>
            <div class="col-md-12">
              <label for="description" class="form-label">Description</label>
              <select class="form-select" id="description" name="description" required>
                <option value="" disabled selected>Select Description</option>
                <option value="Fragile">Fragile</option>
                <option value="Perishable">Perishable</option>
                <option value="Heavy">Heavy</option>
                <option value="Standard">Standard</option>
              </select>
            </div>
            <div class="col-md-12">
              <label for="specificationDescription" class="form-label">Specification Description</label>
              <textarea class="form-control" id="specificationDescription" name="specificationDescription" rows="3" placeholder="Enter the specification of the item" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Item</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Delivery Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="post">
        <div class="modal-body">
          <input type="hidden" id="editId" name="id">
          
          <!-- Modal Form Structure -->
          <div class="row g-3">
            <!-- Sender Name and Receiver Name -->
            <div class="col-md-6">
              <label for="editSenderName" class="form-label">Sender Name</label>
              <input type="text" class="form-control" id="editSenderName" name="senderName" required>
            </div>
            <div class="col-md-6">
              <label for="editReceiverName" class="form-label">Receiver Name</label>
              <input type="text" class="form-control" id="editReceiverName" name="receiverName" required>
            </div>

            <!-- Sender Email and Pickup Time -->
            <div class="col-md-6">
              <label for="editSenderEmail" class="form-label">Sender Email</label>
              <input type="email" class="form-control" id="editSenderEmail" name="senderEmail" required>
            </div>
            <div class="col-md-6">
              <label for="editPickupTime" class="form-label">Pickup Time</label>
              <input type="datetime-local" class="form-control" id="editPickupTime" name="pickupTime" required>
            </div>

            <!-- Sender Phone and Destination -->
            <div class="col-md-6">
              <label for="editSenderPhone" class="form-label">Sender Phone</label>
              <input type="tel" class="form-control" id="editSenderPhone" name="senderPhone" required>
            </div>
            <div class="col-md-6">
              <label for="editDestination" class="form-label">Destination</label>
              <input type="text" class="form-control" id="editDestination" name="destination" required>
            </div>

            <!-- Description as Dropdown -->
            <div class="col-md-12">
              <label for="editDescription" class="form-label">Description</label>
              <select class="form-select" id="editDescription" name="description" required>
                <option value="" disabled selected>Select Description</option>
                <option value="Fragile">Fragile</option>
                <option value="Electronics">Electronics</option>
                <option value="Clothes">Clothes</option>
                <option value="Furniture">Furniture</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <!-- Specification Description -->
            <div class="col-md-12">
              <label for="editSpecificationDescription" class="form-label">Specification Description</label>
              <textarea class="form-control" id="editSpecificationDescription" name="specificationDescription" rows="4" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Changes</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Cancellation Modal -->
<div id="cancelModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('cancelModal')">&times;</span>
        <h2>Cancel Delivery Item</h2>
        <form id="cancelForm" method="post">
            <input type="hidden" id="cancelId" name="id">
            
            <!-- Modal Form Structure -->
            <div class="modal-form">
                <!-- Sender Name -->
                <div class="modal-row">
                    <div class="modal-column">
                        <label for="senderName">Sender Name:</label>
                        <input type="text" id="cancelSenderName" name="senderName" readonly>
                    </div>
                </div>

                <!-- Receiver Name -->
                <div class="modal-row">
                    <div class="modal-column">
                        <label for="receiverName">Receiver Name:</label>
                        <input type="text" id="cancelReceiverName" name="receiverName" readonly>
                    </div>
                </div>
            </div>

            <!-- Footer with Cancel and Confirm buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="closeModal('cancelModal')">Cancel</button>
                <button type="submit" class="btn btn-success">Confirm Cancellation</button>
            </div>
        </form>
      </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </div>
  
  <script>
$(document).ready(function () {
  // Load delivery items on page load
  loadDeliveryItems();

  // Add a delivery item
  $('#addDeliveryItemForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Validate form inputs
    if (!validateForm('#addDeliveryItemForm')) {
      alert('Please fill out all required fields.');
      return;
    }

    // Prepare form data
    const formData = getFormData('#addDeliveryItemForm');
    
    // Ensure pickupTime is formatted correctly
    if (!formData.pickupTime) {
      alert('Please provide a valid pickup time.');
      return;
    }

    formData.pickupTime = formatDateForAjax(formData.pickupTime);

    // Disable the submit button to prevent multiple submissions
    $('#addDeliveryItemForm button[type="submit"]').prop('disabled', true);

    // Send data using AJAX
    $.ajax({
      url: 'add_delivery_item.php', // Adjust to your server path
      method: 'POST',
      data: JSON.stringify(formData), // Send data as JSON
      contentType: 'application/json', // Set content type to JSON
      success: function (response) {
        console.log('Server Response:', response); // Log server response for debugging
        handleAddItemResponse(response);
      },
      error: function (xhr, status, error) {
        handleAddItemError(xhr, status, error); // Separate error handler for item addition
      },
      complete: function () {
        // Re-enable the submit button after the request completes
        $('#addDeliveryItemForm button[type="submit"]').prop('disabled', false);
      }
    });
  });

  // Other functions (editItem, viewItem, deleteItem, etc.) remain unchanged
});

// Helper function to validate form inputs
function validateForm(formSelector) {
  let isValid = true;
  $(`${formSelector} input, ${formSelector} select, ${formSelector} textarea`).each(function () {
    if ($(this).prop('required') && $(this).val() === '') {
      isValid = false;
    }
  });
  return isValid;
}

// Helper function to format pickup time for AJAX as 'Y-m-d H:i:s'
function formatDateForAjax(date) {
  if (!date) return ''; // If no date is provided, return an empty string
  const d = new Date(date);
  const year = d.getFullYear();
  const month = String(d.getMonth() + 1).padStart(2, '0');
  const day = String(d.getDate()).padStart(2, '0');
  const hours = String(d.getHours()).padStart(2, '0');
  const minutes = String(d.getMinutes()).padStart(2, '0');
  const seconds = String(d.getSeconds()).padStart(2, '0');

  return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

// Helper function to fetch form data
function getFormData(formSelector) {
  const data = {};
  $(`${formSelector} input, ${formSelector} select, ${formSelector} textarea`).each(function () {
    const fieldName = $(this).attr('name');
    const fieldValue = $(this).val();
    data[fieldName] = fieldValue;
  });
  return data;
}

// Helper function to handle AJAX response for adding an item
function handleAddItemResponse(response) {
  try {
    const jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;

    if (jsonResponse.status === 'success') {
      alert('Item added successfully!');
      $('#addItemModal').modal('hide'); // Hide modal after success

      // Dynamically add the new item to the table without reloading the page
      const newItemRow = createTableRow(jsonResponse.data);
      $('#deliveryItemsTable').prepend(newItemRow); // Add the new item at the top of the table

      // Reset the form after submission
      $('#addDeliveryItemForm')[0].reset();
    } else {
      alert(jsonResponse.message || 'Failed to add item.');
    }
  } catch (error) {
    console.error('Error parsing response:', error);
    alert('An error occurred while adding the item. Please try again.');
  }
}

// Helper function to handle AJAX errors specifically for item addition
function handleAddItemError(xhr, status, error) {
  console.error('AJAX Error (Item Addition):', status, error); // Log AJAX error for debugging
  if (xhr.status === 0) {
    alert('Network error. Please check your connection and try again.');
  } else if (xhr.status === 404) {
    alert('Requested resource for adding item not found (404). Please try again later.');
  } else if (xhr.status === 500) {
    alert('Server error (500) while adding item. Please try again later.');
  } else {
    alert('An unexpected error occurred while adding the item. Please try again.');
  }
}

// Load delivery items
function loadDeliveryItems() {
  $.ajax({
    url: 'get_delivery_items.php', // Adjust to your server path
    method: 'GET',
    success: function (response) {
      try {
        const items = typeof response === 'string' ? JSON.parse(response) : response;

        if (!Array.isArray(items)) {
          alert('Invalid data format received.');
          return;
        }

        const tableRows = items.map(item => createTableRow(item)).join('');
        $('#deliveryItemsTable').html(tableRows); // Update the table body
      } catch (error) {
        console.error('Error parsing response:', error);
        alert('An error occurred while loading delivery items.');
      }
    },
    error: function (xhr, status, error) {
      console.error('Error loading delivery items:', status, error);
      alert('Error loading delivery items. Please check your connection and try again.');
    }
  });
}

// Create table row for a delivery item
function createTableRow(item) {
  const formatValue = (value) => value && value.trim() !== '' ? value : 'N/A';

  return `
    <tr>
      <td>${formatValue(item.id)}</td>
      <td>${formatValue(item.senderName)}</td>
      <td>${formatValue(item.receiverName)}</td>
      <td>${formatValue(item.senderEmail)}</td>
      <td>${formatValue(item.senderPhone)}</td>
      <td>${formatValue(item.destination)}</td>
      <td>${formatValue(item.pickupTime)}</td>
      <td>${formatValue(item.paymentType)}</td>
      <td>${formatValue(item.description)}</td>
      <td>${formatValue(item.specificationDescription)}</td>
      <td>${formatValue(item.status || 'Pending')}</td>
      <td>
        <button class="btn btn-sm btn-primary viewItemBtn" data-id="${item.id}">
          <i class="fas fa-eye"></i>
        </button>
        <button class="btn btn-sm btn-warning editItemBtn" data-id="${item.id}">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button class="btn btn-sm btn-danger deleteItemBtn" data-id="${item.id}">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    </tr>`;
}


$(document).on('click', '.editItemBtn', function () {
    const itemId = $(this).data('id'); // Retrieve the item ID from the button's data attribute

    // Clear previous modal fields to avoid showing outdated data
    $('#editId').val('');
    $('#editSenderName').val('');
    $('#editReceiverName').val('');
    $('#editSenderEmail').val('');
    $('#editSenderPhone').val('');
    $('#editDestination').val('');
    $('#editPickupTime').val('');
    $('#editDescription').val('');
    $('#editSpecificationDescription').val('');
    $('#editStatus').val('');
    // No need to reset the tracking ID anymore, so this line is removed
    // $('#editTrackingID').val(''); 

    // Start the AJAX request to fetch the delivery item details
    $.ajax({
        url: 'getDeliveryItemDetails.php',
        method: 'GET',
        data: { id: itemId },
        dataType: 'json',
        success: function (response) {
            console.log('Full Response:', response); // Log the full response for debugging

            // Check if the response is valid and contains the necessary data
            if (response.status === 'success' && response.data && response.data.length > 0) {
                const data = response.data[0]; // Access the first item in the array
                console.log('Fetched Data:', data); // Log the fetched data for debugging

                // Populate form fields with the fetched data
                $('#editId').val(data.id);
                $('#editSenderName').val(data.senderName);
                $('#editReceiverName').val(data.receiverName);
                $('#editSenderEmail').val(data.senderEmail);
                $('#editSenderPhone').val(data.senderPhone);
                $('#editDestination').val(data.destination);

                // Handle pickupTime formatting (from 'YYYY-MM-DD HH:MM:SS' to 'YYYY-MM-DDTHH:MM')
                const pickupTime = data.pickupTime ? data.pickupTime.replace(' ', 'T') : '';
                $('#editPickupTime').val(pickupTime);

                // Populate the description dropdown (assuming description is a string like "Fragile", "Electronics", etc.)
                if (data.description) {
                    $('#editDescription').val(data.description); // Set description in the dropdown
                } else {
                    $('#editDescription').val(''); // Clear the dropdown if description is empty
                }

                // Populate the specification description field (if available)
                $('#editSpecificationDescription').val(data.specificationDescription || ''); 

                // If you have a status field, populate it
                $('#editStatus').val(data.status || ''); 

                // Show the modal for editing the delivery item
                $('#editModal').modal('show');
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


$('#editForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Validate the form before submitting
    if (!validateForm('#editForm')) {
        alert('Please fill out all required fields.');
        return;
    }

    // Prepare form data to be sent
    const formData = {
        id: $('#editId').val(),
        senderName: $('#editSenderName').val(),
        receiverName: $('#editReceiverName').val(),
        senderEmail: $('#editSenderEmail').val(),
        senderPhone: $('#editSenderPhone').val(),
        destination: $('#editDestination').val(),
        pickupTime: formatDateForAjax($('#editPickupTime').val()), // Format date for AJAX
        description: $('#editDescription').val(), // Get description value
        specificationDescription: $('#editSpecificationDescription').val(),
        status: $('#editStatus').val() || "", // Ensure status is set or empty if not available
    };

    // Log formData to ensure it's correct
    console.log('Form Data:', formData);

    // Send the update request
    $.ajax({
        url: 'edit_delivery_item.php', // Corrected URL
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(formData), // Send data as JSON
        success: function (response) {
            console.log('Update Response:', response); // Debug response
            handleAjaxResponse(response, 'Item updated successfully!', 'Failed to update item.');
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', { status, error, responseText: xhr.responseText });
            alert('Error updating item. Please check your connection and try again.');
        }
    });
});

// Format date for AJAX (Ensure the format is compatible with the backend)
function formatDateForAjax(date) {
    if (!date) return '';
    // Format 'YYYY-MM-DDTHH:MM' to 'YYYY-MM-DD HH:MM:SS' (if needed)
    const formattedDate = date.replace('T', ' '); // Change the 'T' separator
    return formattedDate;
}

// Dummy validation function (update based on your form validation rules)
function validateForm(formSelector) {
    const isValid = $(formSelector).find('input, select, textarea').filter(function() {
        return !this.value;
    }).length === 0; // Ensure all fields have a value
    return isValid;
}

// Handle the response from the server
function handleAjaxResponse(response, successMessage, errorMessage) {
    if (response.status === 'success') {
        alert(successMessage);
        // You can close the modal here or refresh the list
        $('#editModal').modal('hide'); // Example: Close modal after success
    } else {
        alert(errorMessage + " " + (response.message || ''));
    }
}

</script>
  


  
  
</body>
</html>