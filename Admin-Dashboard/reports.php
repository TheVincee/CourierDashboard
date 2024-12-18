<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Report</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom Styling for Table */
    .table-container {
      margin-top: 50px;
    }
    .table {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .summary-row td {
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container table-container">
  <h2 class="text-center mb-4">Admin Report: Delivered Items & Salaries</h2>
  
  <!-- Report Table -->
  <table class="table table-bordered table-striped">
    <thead class="table-light">
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Rider Name</th>
        <th scope="col">Items Delivered</th>
        <th scope="col">Salary</th>
      </tr>
    </thead>
    <tbody>
      <!-- Sample Data Rows -->
      <tr>
        <td>2024-12-10</td>
        <td>John Doe</td>
        <td>25</td>
        <td>$1500</td>
      </tr>
      <tr>
        <td>2024-12-11</td>
        <td>Jane Smith</td>
        <td>20</td>
        <td>$1300</td>
      </tr>
      <tr>
        <td>2024-12-12</td>
        <td>Alex Brown</td>
        <td>30</td>
        <td>$1450</td>
      </tr>
    </tbody>
    <tfoot>
      <!-- Summary Row -->
      <tr class="summary-row">
        <td colspan="2" class="text-center">Total</td>
        <td>75</td> <!-- Total Items Delivered -->
        <td>$5250</td> <!-- Total Salaries -->
      </tr>
      <tr class="summary-row">
        <td colspan="4" class="text-center">Overview: Total Items Delivered and Total Salaries</td>
      </tr>
    </tfoot>
  </table>

  <!-- Overview Section -->
  <div class="row mt-4">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Overview</h5>
          <p>Total Items Delivered: <strong>75</strong></p>
          <p>Total Salaries Paid: <strong>$5250</strong></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (Optional for further interactions like modals, tooltips, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
