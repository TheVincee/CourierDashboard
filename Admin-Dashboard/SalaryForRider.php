<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Salary Calculator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    <h1>Rider Salary Calculator</h1>

    <button id="fetchRiders">Fetch Riders</button>

    <form id="salaryForm">
        <label for="riderId">Select Rider:</label>
        <select id="riderId" name="riderId" required>
            <option value="">Select Rider</option>
        </select>

        <br><br>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" readonly required>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" readonly required>

        <br><br>

        <label for="itemsDelivered">Items Delivered:</label>
        <input type="number" id="itemsDelivered" name="itemsDelivered" min="0" required>

        <label for="distanceTraveled">Distance Traveled (km):</label>
        <input type="number" id="distanceTraveled" name="distanceTraveled" step="0.1" min="0" required>

        <label for="extraMiles">Extra Miles:</label>
        <input type="number" id="extraMiles" name="extraMiles" step="0.1" min="0" required>

        <br><br>

        <p>Total Salary: <span id="totalSalary">₱0.00</span></p>

        <button type="submit">Calculate and Save Salary</button>
    </form>

    <script>
        $(document).ready(function () {
            const baseSalary = 5000;
            const perItemRate = 50;
            const perKmRate = 10;
            const bonusRate = 5;

            $('#fetchRiders').on('click', function () {
                $.ajax({
                    url: 'getriderSalary.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            const riders = response.riders;
                            let options = '<option value="">Select Rider</option>';
                            riders.forEach(rider => {
                                options += `<option value="${rider.riders_id}">${rider.first_name} ${rider.last_name}</option>`;
                            });
                            $('#riderId').html(options);
                        } else {
                            alert(response.message);
                            $('#riderId').html('<option value="">No riders available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', xhr.responseText, { status, error });
                        alert('Failed to fetch riders. Please try again.');
                    }
                });
            });

            $('#riderId').on('change', function () {
                const riderID = $(this).val().trim();
                if (riderID) {
                    $.ajax({
                        url: 'getriderSalary.php',
                        type: 'GET',
                        data: { ridersId: riderID },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                const rider = response.rider;
                                $('#firstName').val(rider.first_name);
                                $('#lastName').val(rider.last_name);
                            } else {
                                alert(response.message);
                                $('#firstName, #lastName').val('');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX Error:', xhr.responseText, { status, error });
                            alert('Failed to fetch rider details. Please try again.');
                        }
                    });
                } else {
                    $('#firstName, #lastName').val('');
                }
            });

            $('#salaryForm').on('submit', function (event) {
                event.preventDefault();

                const riderID = $('#riderId').val().trim();
                const firstName = $('#firstName').val().trim();
                const lastName = $('#lastName').val().trim();
                const itemsDelivered = parseInt($('#itemsDelivered').val()) || 0;
                const distanceTraveled = parseFloat($('#distanceTraveled').val()) || 0;
                const extraMiles = parseFloat($('#extraMiles').val()) || 0;

                if (!riderID || !firstName || !lastName || itemsDelivered < 0 || distanceTraveled < 0 || extraMiles < 0) {
                    alert('All fields are required and must be valid.');
                    return;
                }

                const totalSalary = baseSalary + (itemsDelivered * perItemRate) +
                    (distanceTraveled * perKmRate) + (extraMiles * bonusRate);

                $('#totalSalary').text(`₱${totalSalary.toFixed(2)}`);

                $.ajax({
                    url: 'insert_salary.php',
                    type: 'POST',
                    data: {
                        riderId: riderID,
                        firstName: firstName,
                        lastName: lastName,
                        itemsDelivered: itemsDelivered,
                        distanceTraveled: distanceTraveled,
                        extraMiles: extraMiles,
                        totalSalary: totalSalary
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            toastr.success('Salary is ready to claim!', 'Notification', {
                                onclick: function() {
                                    window.location.href = 'NotificationSalary.php';
                                }
                            });
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', xhr.responseText, { status, error });
                        alert('An error occurred while inserting salary. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>