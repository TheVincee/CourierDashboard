<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pickup Items Table</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    /* General Styles */
    body {
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    /* Container for centering content */
    .container {
      width: 90%;
      max-width: 1200px;
      margin: auto;
    }

    /* Card styling */
    .card {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Header inside the card */
    .card-header {
      background: linear-gradient(90deg, #007bff, #0056b3);
      color: white;
      font-size: 0.875rem; /* Further reduced font size */
      font-weight: bold;
      padding: 10px;
      text-align: center;
      border-bottom: 2px solid #0056b3;
    }

    /* Table Styling */
    .table {
      margin: 15px auto;
      width: 100%;
      max-width: 100%;
      table-layout: auto;
      border-collapse: collapse;
    }

    .table th,
    .table td {
      padding: 8px; /* Further reduced padding */
      text-align: center;
      border-bottom: 1px solid #ddd;
      word-wrap: break-word;
      font-size: 0.8rem; /* Further reduced font size */
    }

    /* Header Cell Styling */
    .table th {
      background-color: #007bff;
      color: white;
      font-weight: bold;
      text-transform: uppercase;
    }

    /* Hover effect for table rows */
    .table-hover tbody tr:hover {
      background-color: #f1f1f1;
      transition: background-color 0.3s ease;
    }

    /* Badge Styling for Status */
    .badge {
      font-size: 0.8rem;
      padding: 6px 12px;
      border-radius: 12px;
    }

    .badge-warning {
      background-color: #ffc107;
      color: #333;
    }

    .badge-success {
      background-color: #28a745;
      color: white;
    }

    /* Modal Styling */
    .modal-header {
      background-color: #007bff;
      color: white;
      padding: 10px;
      border-bottom: 2px solid #0056b3;
    }

    /* Modal footer */
    .modal-footer .btn-primary {
      background-color: #007bff;
      border: none;
      padding: 6px 12px; /* Reduced padding */
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .modal-footer .btn-primary:hover {
      background-color: #0056b3;
      transform: scale(1.05);
    }

    /* Input fields */
    input[type="text"],
    input[type="datetime-local"],
    select.form-select,
    textarea.form-control {
      width: 100%;
      padding: 8px; /* Further reduced padding */
      margin-bottom: 8px;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: border 0.3s ease;
    }

    /* Input focus effect */
    input[type="text"]:focus,
    input[type="datetime-local"]:focus,
    select.form-select:focus,
    textarea.form-control:focus {
      border-color: #007bff;
      outline: none;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card">
    <div class="card-header">
      Pickup Item Details
    </div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Sender Name</th>
            <th>Receiver Name</th>
            <th>Destination</th>
            <th>Pickup Time</th>
            <th>Payment Type</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>John Doe</td>
            <td>Jane Smith</td>
            <td>123 Main St</td>
            <td>2024-12-10 10:00 AM</td>
            <td>Cash</td>
            <td><span class="badge badge-warning">On Route</span></td>
            <td>
              <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="1">
                <i class="fas fa-eye"></i>
              </button>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="1">
                <i class="fas fa-pencil-alt"></i>
              </button>
              <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#declineModal" data-id="1">
                <i class="fas fa-times-circle"></i>
              </button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Michael Johnson</td>
            <td>Amy Lee</td>
            <td>456 Oak St</td>
            <td>2024-12-10 12:30 PM</td>
            <td>Online Payment</td>
            <td><span class="badge badge-success">Received Package</span></td>
            <td>
              <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="2">
                <i class="fas fa-eye"></i>
              </button>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="2">
                <i class="fas fa-pencil-alt"></i>
              </button>
              <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#declineModal" data-id="2">
                <i class="fas fa-times-circle"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- View Modal -->
      <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewModalLabel">Pickup Item Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="viewDetails"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Update Status Modal -->
      <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateModalLabel">Update Pickup Status</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="updateStatusForm">
                <div class="mb-3">
                  <label for="statusSelect" class="form-label">Select Status</label>
                  <select class="form-select" id="statusSelect" required>
                    <option value="On Route">On Route</option>
                    <option value="Received Package">Received Package</option>
                    <option value="Completed">Completed</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update Status</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Decline Modal -->
      <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="declineModalLabel">Decline Pickup Request</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="declineForm">
                <div class="mb-3">
                  <label for="declineReason" class="form-label">Reason for Decline</label>
                  <textarea class="form-control" id="declineReason" required></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Decline</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

<script>
  // Update Status Modal Handling
  const updateButtons = document.querySelectorAll('[data-bs-target="#updateModal"]');
  updateButtons.forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      // Optionally, pre-fill the modal with item details if needed
      console.log(`Updating status for item with ID: ${id}`);
    });
  });

  // View Modal Handling
  const viewButtons = document.querySelectorAll('[data-bs-target="#viewModal"]');
  viewButtons.forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      // Optionally, pre-fill the modal with item details if needed
      console.log(`Viewing details for item with ID: ${id}`);
    });
  });

  // Decline Modal Handling
  const declineButtons = document.querySelectorAll('[data-bs-target="#declineModal"]');
  declineButtons.forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      // Optionally, pre-fill the modal with item details if needed
      console.log(`Decline reason for item with ID: ${id}`);
    });
  });
</script>
</body>
</html>
