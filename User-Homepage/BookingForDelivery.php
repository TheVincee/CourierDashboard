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
                <input type="text" class="form-control" id="senderName" placeholder="Enter sender's name" required>
              </div>
              <div class="col-md-6">
                <label for="receiverName" class="form-label">Receiver Name</label>
                <input type="text" class="form-control" id="receiverName" placeholder="Enter receiver's name" required>
              </div>
              <div class="col-md-6">
                <label for="senderEmail" class="form-label">Sender Email</label>
                <input type="email" class="form-control" id="senderEmail" placeholder="Enter sender's email" required>
              </div>
              <div class="col-md-6">
                <label for="senderPhone" class="form-label">Sender Phone Number</label>
                <input type="tel" class="form-control" id="senderPhone" placeholder="Enter sender's phone number" required>
              </div>
              <div class="col-md-12">
                <label for="destination" class="form-label">Destination</label>
                <input type="text" class="form-control" id="destination" placeholder="Enter destination" required>
              </div>
              <div class="col-md-6">
                <label for="pickupTime" class="form-label">Pickup Time</label>
                <input type="datetime-local" class="form-control" id="pickupTime" required>
              </div>
              <div class="col-md-6">
                <label for="paymentType" class="form-label">Payment Type</label>
                <select class="form-select" id="paymentType" required>
                  <option value="" disabled selected>Select Payment Type</option>
                  <option value="Cash">Cash</option>
                  <option value="Card">Card</option>
                  <option value="Online">Online Payment</option>
                </select>
              </div>
              <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <select class="form-select" id="description" required>
                  <option value="" disabled selected>Select Description</option>
                  <option value="Fragile">Fragile</option>
                  <option value="Perishable">Perishable</option>
                  <option value="Heavy">Heavy</option>
                  <option value="Standard">Standard</option>
                </select>
              </div>
              <div class="col-md-12">
                <label for="specificationDescription" class="form-label">Specification Description</label>
                <textarea class="form-control" id="specificationDescription" rows="3" placeholder="Enter the specification of the item" required></textarea>
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
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h2>Edit Delivery Item</h2>
        <form id="editForm" method="post">
            <input type="hidden" id="editId" name="id">
            
            <!-- Modal Form Structure -->
            <div class="modal-form">
                <!-- Sender Name and Receiver Name -->
                <div class="modal-row">
                    <div class="modal-column">
                        <label for="senderName">Sender Name:</label>
                        <input type="text" id="editSenderName" name="senderName" required>
                    </div>
                    <div class="modal-column">
                        <label for="receiverName">Receiver Name:</label>
                        <input type="text" id="editReceiverName" name="receiverName" required>
                    </div>
                </div>

                <!-- Sender Email and Pickup Time -->
                <div class="modal-row">
                    <div class="modal-column">
                        <label for="senderEmail">Sender Email:</label>
                        <input type="email" id="editSenderEmail" name="senderEmail" required>
                    </div>
                    <div class="modal-column">
                        <label for="pickupTime">Pickup Time:</label>
                        <input type="datetime-local" id="editPickupTime" name="pickupTime" required>
                    </div>
                </div>

                <!-- Destination -->
                <div class="modal-row">
                    <div class="modal-column">
                        <label for="destination">Destination:</label>
                        <input type="text" id="editDestination" name="destination" required>
                    </div>
                </div>

                <!-- Description as Dropdown -->
                <div class="modal-row">
                    <div class="modal-column">
                        <label for="description">Description:</label>
                        <select id="editDescription" name="description" required>
                            <option value="">Select Description</option>
                            <option value="Fragile">Fragile</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Clothes">Clothes</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Specification Description -->
                <div class="modal-row">
                    <div class="modal-column">
                        <label for="specificationDescription">Specification Description:</label>
                        <textarea id="editSpecificationDescription" name="specificationDescription" rows="4" required></textarea>
                    </div>
                </div>
            </div>

            <!-- Footer with Save and Cancel buttons -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Changes</button>
                <button type="button" class="btn btn-danger" onclick="closeModal('editModal')">Cancel</button>
            </div>
        </form>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
 $(document).ready(function () {
  // Load delivery items on page load
  loadDeliveryItems();

  // Add a delivery item
  $('#addDeliveryItemForm').on('submit', function (e) {
    e.preventDefault();

    // Validate form inputs
    if (!validateForm()) {
      alert('Please fill out all required fields.');
      return;
    }

    // Prepare form data
    const formData = getFormData();

    // Ensure pickupTime is formatted correctly
    formData.pickupTime = formatDateForAjax(formData.pickupTime);

    $.ajax({
      url: 'add_delivery_item.php', // Adjust to your server path
      method: 'POST',
      data: JSON.stringify(formData),
      contentType: 'application/json',
      success: function (response) {
        handleAjaxResponse(response, 'Item added successfully!', 'Failed to add item.');
      },
      error: function () {
        alert('Error adding item. Please check your connection and try again.');
      }
    });
  });

  // Edit a delivery item
  $(document).on('click', '.editItemBtn', function () {
    const id = $(this).data('id');
    editItem(id);
  });

  // Submit the edited delivery item
  $('#editDeliveryItemForm').on('submit', function (e) {
    e.preventDefault();

    // Validate form inputs
    if (!validateForm()) {
      alert('Please fill out all required fields.');
      return;
    }

    // Prepare form data for edit
    const formData = getFormData();
    formData.id = $('#editItemId').val(); // Add item ID to the form data

    // Ensure pickupTime is formatted correctly
    formData.pickupTime = formatDateForAjax(formData.pickupTime);

    $.ajax({
      url: 'edit_delivery_item.php', // Adjust to your server path
      method: 'POST',
      data: JSON.stringify(formData),
      contentType: 'application/json',
      success: function (response) {
        handleAjaxResponse(response, 'Item updated successfully!', 'Failed to update item.');
      },
      error: function () {
        alert('Error updating item. Please check your connection and try again.');
      }
    });
  });

  // View a delivery item
  $(document).on('click', '.viewItemBtn', function () {
    const id = $(this).data('id');
    viewItem(id);
  });

  // Delete a delivery item
  $(document).on('click', '.deleteItemBtn', function () {
    const id = $(this).data('id');
    deleteItem(id);
  });
});

// Helper function to format pickup time for AJAX as 'Y-m-d H:i:s'
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

// Helper function to fetch form data
function getFormData() {
  return {
    senderName: $('#senderName').val(),
    receiverName: $('#receiverName').val(),
    senderEmail: $('#senderEmail').val(),
    senderPhone: $('#senderPhone').val(),
    destination: $('#destination').val(),
    pickupTime: $('#pickupTime').val(),
    paymentType: $('#paymentType').val(),
    description: $('#description').val(),
    specificationDescription: $('#specificationDescription').val(),
  };
}

// Helper function to handle AJAX responses
function handleAjaxResponse(response, successMessage, errorMessage) {
  try {
    const jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;

    if (jsonResponse.success) {
      alert(successMessage);
      $('#addItemModal').modal('hide');
      $('#editItemModal').modal('hide');
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

// Edit a delivery item
function editItem(id) {
  $.ajax({
    url: `get_delivery_items.php?id=${id}`,
    method: 'GET',
    success: function (response) {
      try {
        const item = typeof response === 'string' ? JSON.parse(response) : response;

        if (item) {
          // Populate the edit form with the item details
          $('#editItemId').val(item.id);
          $('#senderName').val(item.senderName);
          $('#receiverName').val(item.receiverName);
          $('#senderEmail').val(item.senderEmail);
          $('#senderPhone').val(item.senderPhone);
          $('#destination').val(item.destination);
          $('#pickupTime').val(item.pickupTime);
          $('#paymentType').val(item.paymentType);
          $('#description').val(item.description);
          $('#specificationDescription').val(item.specificationDescription);

          // Show the modal
          $('#editItemModal').modal('show');
        } else {
          alert('Item not found.');
        }
      } catch (error) {
        console.error('Error parsing response:', error);
        alert('An error occurred while fetching the item data for editing.');
      }
    },
    error: function () {
      alert('Error fetching item data. Please check your connection and try again.');
    }
  });
}

// View a delivery item
function viewItem(id) {
  $.ajax({
    url: `get_delivery_item.php?id=${id}`,
    method: 'GET',
    success: function (response) {
      try {
        const item = typeof response === 'string' ? JSON.parse(response) : response;

        if (item) {
          displayItemDetails(item);
          $('#viewItemModal').modal('show');
        } else {
          alert('Item not found.');
        }
      } catch (error) {
        console.error('Error parsing response:', error);
        alert('An error occurred while viewing the item.');
      }
    },
    error: function () {
      alert('Error fetching item data. Please check your connection and try again.');
    }
  });
}

// Display item details in modal
function displayItemDetails(item) {
  $('#viewSenderName').text(item.senderName || 'N/A');
  $('#viewReceiverName').text(item.receiverName || 'N/A');
  $('#viewSenderEmail').text(item.senderEmail || 'N/A');
  $('#viewSenderPhone').text(item.senderPhone || 'N/A');
  $('#viewDestination').text(item.destination || 'N/A');
  $('#viewPickupTime').text(item.pickupTime || 'N/A');
  $('#viewPaymentType').text(item.paymentType || 'N/A');
  $('#viewDescription').text(item.description || 'N/A');
  $('#viewSpecificationDescription').text(item.specificationDescription || 'N/A');
  $('#viewStatus').text(item.status || 'Pending');
}

  </script>
</body>
</html>
