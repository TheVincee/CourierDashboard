<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Salary Calculation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2>Rider Salary Calculation</h2>

        <!-- Salary Calculation Form -->
        <form id="salaryForm" novalidate>
            <div class="mb-3">
                <label for="riderId" class="form-label">Rider ID</label>
                <input type="text" class="form-control" id="riderId" placeholder="Enter rider ID" required>
            </div>
            <div class="mb-3">
                <label for="itemsDelivered" class="form-label">Items Delivered</label>
                <input type="number" class="form-control" id="itemsDelivered" placeholder="Enter items delivered" required>
            </div>
            <div class="mb-3">
                <label for="distanceTraveled" class="form-label">Distance Traveled (km)</label>
                <input type="number" class="form-control" id="distanceTraveled" placeholder="Enter distance traveled" required>
            </div>
            <div class="mb-3">
                <label for="extraMiles" class="form-label">Extra Miles (for bonus)</label>
                <input type="number" class="form-control" id="extraMiles" placeholder="Enter extra miles" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate Salary</button>
        </form>

        <!-- Salary Display -->
        <div class="mt-4">
            <h4>Total Salary: <span id="totalSalary">₱0.00</span></h4>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
    $('#salaryForm').on('submit', function (event) {
        event.preventDefault();

        // Form validation
        if (!this.checkValidity()) {
            this.classList.add('was-validated');
            return;
        }

        // Retrieve input values
        const riderId = $('#riderId').val().trim();
        const itemsDelivered = parseInt($('#itemsDelivered').val()) || 0;
        const distanceTraveled = parseFloat($('#distanceTraveled').val()) || 0;
        const extraMiles = parseFloat($('#extraMiles').val()) || 0;

        // Ensure required fields are filled
        if (!riderId) {
            alert('Rider ID is required.');
            return;
        }

        // Display loading message
        $('#totalSalary').text('Calculating...');

        // AJAX request to calculate salary
        $.ajax({
            url: 'calculate_salary.php', // Backend endpoint
            type: 'POST',
            data: {
                riderId: riderId,
                itemsDelivered: itemsDelivered,
                distanceTraveled: distanceTraveled,
                extraMiles: extraMiles
            },
            dataType: 'json', // Expect JSON response
            success: function (response) {
                if (response.success) {
                    // Update salary display
                    $('#totalSalary').text(`₱${response.totalSalary}`);
                } else {
                    // Show error message from backend
                    alert('Error: ' + response.message);
                    $('#totalSalary').text('₱0.00');
                }
            },
            error: function (xhr, status, error) {
                // Log error details for debugging
                console.error('AJAX Error:', status, error);
                console.error('Response Text:', xhr.responseText);

                // Show a user-friendly error message
                alert('An error occurred while calculating salary. Please try again.');
                $('#totalSalary').text('₱0.00');
            }
        });
    });
});

    </script>
</body>
</html>
