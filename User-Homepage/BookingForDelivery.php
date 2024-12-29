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
    e.preventDefault();

    // Validate form inputs
    if (!validateForm('#addDeliveryItemForm')) {
      alert('Please fill out all required fields.');
      return;
    }

    // Prepare form data
    const formData = getFormData('#addDeliveryItemForm');
    
    // Log form data for debugging
    console.log('Form Data:', formData);

    // Ensure pickupTime is formatted correctly
    if (!formData.pickupTime) {
      alert('Please provide a valid pickup time.');
      return;
    }

    formData.pickupTime = formatDateForAjax(formData.pickupTime);

    // Log formatted data for debugging
    console.log('Formatted Form Data:', formData);

    // Send data using AJAX
    $.ajax({
      url: 'add_delivery_item.php', // Adjust to your server path
      method: 'POST',
      data: JSON.stringify(formData),
      contentType: 'application/json',
      success: function (response) {
        console.log('Server Response:', response); // Log server response for debugging
        handleAjaxResponse(response, 'Item added successfully!', 'Failed to add item.');
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error:', status, error); // Log AJAX error for debugging
        alert('Error adding item. Please check your connection and try again.');
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
      console.log('Validation failed for:', $(this).attr('name')); // Log the field that failed validation
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

// Helper function to handle AJAX responses
function handleAjaxResponse(response, successMessage, errorMessage) {
  try {
    const jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;

    if (jsonResponse.message === 'Item added successfully') {
      alert(successMessage);
      $('#addItemModal').modal('hide');
      loadDeliveryItems(); // Reload the delivery items table
    } else {
      alert(jsonResponse.message || errorMessage);
    }
  } catch (error) {
    console.error('Error parsing response:', error);
    alert('An error occurred. Please try again.');
  }
}

// Load delivery items
function loadDeliveryItems() {
  $.ajax({
    url: 'get_delivery_items.php',
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
    error: function () {
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



  // Edit item logic
  $(document).on('click', '.editItemBtn', function () {
    const itemId = $(this).data('id'); // Retrieve the item ID from the button's data attribute

    $.ajax({
  url: 'getDeliveryItemDetails.php',
  method: 'GET',
  data: { id: itemId },
  dataType: 'json',
  success: function (response) {
    console.log('Fetch Response:', response); // Log fetch response for debugging
    if (response.status === 'success') {
      // Populate form fields with the fetched data
      $('#editId').val(response.data.id);
      $('#editSenderName').val(response.data.senderName);
      $('#editReceiverName').val(response.data.receiverName);
      $('#editSenderEmail').val(response.data.senderEmail);
      $('#editSenderPhone').val(response.data.senderPhone);
      $('#editDestination').val(response.data.destination);
      
      // Check if pickupTime exists and is valid, then format it
      const pickupTime = response.data.pickupTime ? response.data.pickupTime.replace(' ', 'T') : '';
      $('#editPickupTime').val(pickupTime);

      $('#editDescription').val(response.data.description);
      $('#editSpecificationDescription').val(response.data.specificationDescription);
      $('#editModal').modal('show'); // Show the modal for editing
    } else {
      alert(response.message || 'Error fetching delivery item details.');
    }
  },
  error: function (xhr, status, error) {
    console.error('AJAX Error:', status, error);
    alert('Error fetching delivery item details. Please try again.');
  }
});

  });

  // Update item logic
  $('#editForm').on('submit', function (e) {
    e.preventDefault();

    if (!validateForm('#editForm')) {
      alert('Please fill out all required fields.');
      return;
    }

    const formData = {
      id: $('#editId').val(),
      senderName: $('#editSenderName').val(),
      receiverName: $('#editReceiverName').val(),
      senderEmail: $('#editSenderEmail').val(),
      senderPhone: $('#editSenderPhone').val(),
      destination: $('#editDestination').val(),
      pickupTime: formatDateForAjax($('#editPickupTime').val()),
      description: $('#editDescription').val(),
      specificationDescription: $('#editSpecificationDescription').val(),
      status: 'Pending', // Assuming status is 'Pending'
    };

    $.ajax({
      url: 'edit_delivery_item.php',
      method: 'POST',
      data: formData, // Send data as form data (not JSON)
      success: function (response) {
        handleAjaxResponse(response, 'Item updated successfully!', 'Failed to update item.');
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error:', status, error);
        alert('Error updating item. Please check your connection and try again.');
      }
    });
  });

  // Helper function to validate form inputs
  function validateForm(formSelector) {
    let isValid = true;
    $(`${formSelector} input, ${formSelector} select, ${formSelector} textarea`).each(function () {
      $(this).css('border', ''); // Reset the border before checking
      if ($(this).prop('required') && $(this).val() === '') {
        $(this).css('border', '1px solid red'); // Highlight invalid fields
        isValid = false;
      }
    });
    return isValid;
  }

  // Helper function to format date for AJAX
  function formatDateForAjax(date) {
    const d = new Date(date);
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    const hours = String(d.getHours()).padStart(2, '0');
    const minutes = String(d.getMinutes()).padStart(2, '0');
    const seconds = String(d.getSeconds()).padStart(2, '0');
    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
  }

  // Helper function to handle AJAX responses
  function handleAjaxResponse(response, successMessage, errorMessage) {
    if (response.status === 'success') {
      alert(successMessage);
      loadDeliveryItems(); // Reload the table to reflect changes
      $('#editModal').modal('hide'); // Close the modal after successful update
    } else {
      alert(response.message || errorMessage);
    }
  }

  // Helper function to get form data
  function getFormData(formSelector) {
    const formData = {};
    $(`${formSelector} input, ${formSelector} select, ${formSelector} textarea`).each(function () {
      formData[$(this).attr('name')] = $(this).val();
    });
    return formData;
  }

  // Close modal
  $(document).on('click', '.close', function () {
    $('#editModal').modal('hide'); // Hide modal when close button is clicked
  });

  $(window).on('click', function (event) {
    if ($(event.target).hasClass('modal')) {
      $('#editModal').modal('hide'); // Close modal if user clicks outside of it
    }
  });

</script>
  


  
  
</body>
</html>