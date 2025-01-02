<?php
// Start the session
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include 'conn.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to signin page if not logged in
    header("Location: signin.php");
    exit;
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch the username from the users table using the user_id
$sql_user = "SELECT username FROM users WHERE id = ?";
if ($stmt_user = $conn->prepare($sql_user)) {
    $stmt_user->bind_param("i", $user_id);
    $stmt_user->execute();
    $stmt_user->bind_result($username);
    $stmt_user->fetch();
    $stmt_user->close();
} else {
    die("Error preparing user query: " . $conn->error);
}

// Initialize $result as null
$result = null;

// Fetch all bookings for the logged-in user from the bookings table
$sql = "SELECT name, pickup_location, dropoff_location, date, time, status 
        FROM bookings 
        WHERE username = ?"; // Filter bookings by username

if ($stmt = $conn->prepare($sql)) {
    // Bind the username to get bookings for the logged-in user
    $stmt->bind_param("s", $username);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Get the result set
        $result = $stmt->get_result();
    } else {
        echo "Error executing booking query: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing booking query: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History | User Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #d21f3c;
            color: white;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: white !important;
            font-weight: bold;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .card-header {
            background-color: #d21f3c;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            border-radius: 15px 15px 0 0;
        }
        .table thead {
            background-color: #d21f3c;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #ffe5e5;
        }
        .btn-primary {
            background-color: #d21f3c;
            border: none;
        }
        .btn-primary:hover {
            background-color: #a9142d;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Transport Booking</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="user_index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Booking History
                    </div>
                    <div class="card-body">
                        <?php if ($result && $result->num_rows > 0): ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Pickup Location</th>
                                        <th>Dropoff Location</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['pickup_location']; ?></td>
                                            <td><?php echo $row['dropoff_location']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['time']; ?></td>
                                            <td><?php echo ucfirst($row['status']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-center text-lg font-semibold text-gray-700">You have no booking history yet.</p>
                        <?php endif; ?>
                        <div class="text-center mt-4">
                            <a href="user_index.php" class="btn btn-primary">Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
