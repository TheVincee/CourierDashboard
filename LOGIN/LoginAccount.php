<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "courier_db"; // Your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validation
    if (empty($email) || empty($password)) {
        echo "All fields are required.";
        exit();
    }

    // First, check the users_tb (for regular users)
    $stmt = $conn->prepare("SELECT id, name, password, role FROM users_tb WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists in users_tb
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_role'] = $row['role'];

            // Redirect based on role
            if (strtolower($row['role']) == 'admin') {
                header("Location: AdminDashboard.php");
                exit();
            } elseif (strtolower($row['role']) == 'user') {
                header("Location: /User-Homepage/UserProfile.php");
                exit();
            } else {
                // If role is not recognized
                echo "Unknown role: " . $row['role'];
                exit();
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        // Check the riders_tb (for riders)
        $stmt_rider = $conn->prepare("SELECT id, first_name, password, role FROM riders WHERE email = ?");
        $stmt_rider->bind_param("s", $email);
        $stmt_rider->execute();
        $result_rider = $stmt_rider->get_result();

        if ($result_rider->num_rows > 0) {
            $row_rider = $result_rider->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row_rider['password'])) {
                // Set session variables for rider
                $_SESSION['user_id'] = $row_rider['id'];
                $_SESSION['user_name'] = $row_rider['first_name']; // assuming rider first name
                $_SESSION['user_role'] = $row_rider['role'];

                // Redirect to rider's dashboard
                if (strtolower($row_rider['role']) == 'rider') {
                    header("Location: /Riders-Dashboard/RiderHomepage.php");
                    exit();
                } else {
                    echo "Unknown role: " . $row_rider['role'];
                    exit();
                }
            } else {
                echo "Invalid password for rider.";
            }
        } else {
            echo "No user or rider found with this email.";
        }
    }

    // Close the statement
    $stmt->close();
    $stmt_rider->close();
}

// Close the connection
$conn->close();
?>
