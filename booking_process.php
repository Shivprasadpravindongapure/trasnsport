<?php
// Start the session
session_start();

// Include the database connection
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
    $stmt_user->bind_param("i", $user_id); // Bind the user ID
    $stmt_user->execute();
    $stmt_user->bind_result($username);
    $stmt_user->fetch();
    $stmt_user->close();
} else {
    die("Error preparing user query: " . $conn->error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $pickup_location = $_POST['pickup_location'];
    $dropoff_location = $_POST['dropoff_location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $name = $_POST['name'];
    $price = floatval($_POST['ticket_price']); // Convert price to float

    // Prepare the SQL statement to insert data into bookings table
    $sql = "INSERT INTO bookings (name, username, pickup_location, dropoff_location, date, time, price)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssd", $name, $username, $pickup_location, $dropoff_location, $date, $time, $price);

        if ($stmt->execute()) {
            echo "<script>alert('Booking successful!'); window.location.href = 'booking.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
