<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rider Salaries</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom Styling for Table */
    .table {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Rider Salary Records</h2>
  
  <!-- Table -->
  <table class="table table-bordered table-striped">
    <thead class="table-light">
      <tr>
        <th scope="col">Rider Name</th>
        <th scope="col">Salary Amount</th>
        <th scope="col">Payment Date</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John Doe</td>
        <td>$1500</td>
        <td>2024-12-10</td>
        <td><span class="badge bg-success">Paid</span></td>
      </tr>
      <tr>
        <td>Jane Smith</td>
        <td>$1300</td>
        <td>2024-12-08</td>
        <td><span class="badge bg-warning">Pending</span></td>
      </tr>
      <tr>
        <td>Alex Brown</td>
        <td>$1450</td>
        <td>2024-12-12</td>
        <td><span class="badge bg-danger">Overdue</span></td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Bootstrap JS (Optional for further interactions like modals, tooltips, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
