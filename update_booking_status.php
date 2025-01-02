<?php
// Start the session
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Include database connection
include 'conn.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the booking ID and new status from the form
    $booking_id = $_POST['booking_id'];
    $new_status = $_POST['status'];

    // Update the status in the database
    $sql = "UPDATE bookings SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_status, $booking_id);

    if ($stmt->execute()) {
        // Set a session variable for success message
        $_SESSION['status_message'] = "Booking status updated successfully!";
        header("Location: admin_dashboard1.php");
        exit;
    } else {
        // Set an error message if the update fails
        $_SESSION['status_message'] = "Error updating status: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
