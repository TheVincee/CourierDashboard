<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assigned Riders</title>
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
  </style>
</head>
<body>

<div class="container table-container">
  <h2 class="text-center mb-4">Assigned Riders</h2>
  
  <!-- Assigned Riders Table -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-light">
        <tr>
          <th scope="col">Rider ID</th>
          <th scope="col">Rider Name</th>
          <th scope="col">Assigned Area</th>
          <th scope="col">Assignment Date</th>
        </tr>
      </thead>
      <tbody>
        <!-- Sample Data Rows -->
        <tr>
          <td>R001</td>
          <td>John Doe</td>
          <td>Downtown</td>
          <td>2024-12-15</td>
        </tr>
        <tr>
          <td>R002</td>
          <td>Jane Smith</td>
          <td>Uptown</td>
          <td>2024-12-16</td>
        </tr>
        <tr>
          <td>R003</td>
          <td>Alex Brown</td>
          <td>Suburbs</td>
          <td>2024-12-17</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap JS (Optional for further interactions like modals, tooltips, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
