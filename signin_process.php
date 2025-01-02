<?php
// Start the session
session_start();

// Include the database connection
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to get the user by email
    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows == 1) {
        // Bind the result (user ID and hashed password)
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify the password against the stored hashed password
        if (password_verify($password, $hashed_password)) {
            // Set session variables for the logged-in user
            $_SESSION['user_id'] = $user_id;
            $_SESSION['logged_in'] = true;

            // Redirect to the dashboard page
            header("Location: user_index.php");
            exit;
        } else {
            // Invalid password
            $_SESSION['error_message'] = "Invalid email or password!";
        }
    } else {
        // User not found
        $_SESSION['error_message'] = "Invalid email or password!";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the sign-in page with an error message
    header("Location: signin.php");
    exit;
}
?>
