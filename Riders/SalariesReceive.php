<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Salaries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Rider Salaries</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Items Delivered</th>
                    <th>Distance Traveled</th>
                    <th>Extra Miles</th>
                    <th>Total Salary</th>
                </tr>
            </thead>
            <tbody id="salariesTable">
                <!-- Salary rows will be dynamically populated -->
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    const riderID = 1; // Replace with the actual rider ID

    // Function to load salaries into the table
    function loadSalaries() {
        $.ajax({
            url: 'fetchSalaries.php',  // PHP script for fetching salaries
            type: 'GET',
            data: { riderId: riderID },
            dataType: 'json',
            success: function(data) {
                if (data.success && Array.isArray(data.salaries)) {
                    const tableBody = $("#salariesTable");
                    tableBody.empty(); // Clear existing rows

                    data.salaries.forEach((salary, index) => {
                        const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${salary.first_name}</td>
                                <td>${salary.last_name}</td>
                                <td>${salary.items_delivered}</td>
                                <td>${salary.distance_traveled}</td>
                                <td>${salary.extra_miles}</td>
                                <td>${salary.total_salary}</td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                } else {
                    alert('Error fetching salaries: ' + (data.message || 'No salaries available.'));
                }
            },
            error: function() {
                alert("Error fetching salaries. Please try again.");
            }
        });
    }

    // Initial load of salaries when page loads
    loadSalaries();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>