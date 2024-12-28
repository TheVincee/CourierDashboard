<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Notification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .notification-icon {
            font-size: 60px;
            color: #FFD700;
            cursor: pointer;
            position: relative;
        }
        .notification-icon:hover {
            transform: scale(1.1);
        }
        .notification-count {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border-radius: 50%;
            font-size: 14px;
            width: 24px;
            height: 24px;
            line-height: 24px;
            text-align: center;
        }
        .notification-list {
            margin-top: 20px;
            display: none;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            background-color: #f9f9f9;
        }
        .notification-list h3 {
            margin-top: 0;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="notification-icon" onclick="fetchNotifications()">
        <i class="fas fa-bell"></i>
        <div class="notification-count" id="notificationCount">0</div>
    </div>

    <div class="notification-list" id="notificationList">
        <h3>Salary Notifications</h3>
        <ul id="notifications"></ul>
    </div>

    <script>
        function fetchNotifications() {
            $.ajax({
                url: 'fetchSalaries_tb.php', // Ensure this is the correct path
                method: 'GET',
                dataType: 'json', // Explicitly specify the expected response format
                success: function(data) {
                    if (typeof data === 'string') {
                        try {
                            data = JSON.parse(data); // Parse the JSON string
                        } catch (e) {
                            console.error('Failed to parse JSON:', e);
                            alert('Failed to fetch notifications. Invalid JSON format.');
                            return;
                        }
                    }

                    if (!Array.isArray(data)) {
                        console.error('Invalid data format:', data);
                        alert('Failed to fetch notifications. Data is not an array.');
                        return;
                    }

                    const notificationList = document.getElementById('notifications');
                    const notificationContainer = document.getElementById('notificationList');
                    const notificationCount = document.getElementById('notificationCount');

                    notificationList.innerHTML = ''; // Clear previous notifications

                    const count = data.length; // Count the notifications
                    notificationCount.textContent = count; // Update the count in the UI

                    if (count > 0) {
                        data.forEach(notification => {
                            const listItem = document.createElement('li');
                            listItem.textContent = `${notification.first_name} ${notification.last_name}: $${notification.total_salary}`;
                            notificationList.appendChild(listItem);
                        });
                        notificationContainer.style.display = 'block'; // Show notification list
                    } else {
                        notificationList.innerHTML = '<li>No new notifications</li>';
                        notificationContainer.style.display = 'block'; // Show empty notification list
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                    alert('Failed to fetch notifications.');
                }
            });
        }
    </script>
</body>
</html>
