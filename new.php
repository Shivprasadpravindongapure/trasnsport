<?php
session_start(); // Start the session to store OTP

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the user input
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $phone_number = trim($_POST['phone_number']);

    // Validate user input
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($username) && !empty($phone_number)) {
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Store the OTP and user data in session
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        $_SESSION['phone_number'] = $phone_number;

        // Display the generated OTP (for demonstration purposes)
        echo "<div>OTP generated: <strong>$otp</strong></div>";
    } else {
        echo "<div>Please enter valid details.</div>";
    }
}

// Check if the OTP is being validated
if (isset($_POST['verify_otp'])) {
    $entered_otp = trim($_POST['otp']);

    // Validate the entered OTP
    if (isset($_SESSION['otp']) && $entered_otp == $_SESSION['otp']) {
        echo "<div>OTP verification successful! Welcome, " . htmlspecialchars($_SESSION['username']) . ".</div>";
        // Optionally, you might want to unset the session variables after successful verification
        unset($_SESSION['otp']);
        unset($_SESSION['email']);
        unset($_SESSION['username']);
        unset($_SESSION['phone_number']);
    } else {
        echo "<div>Invalid OTP. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Validation Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 400px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>OTP Generation and Validation</h2>

<!-- Form to take user details and generate OTP -->
<form method="POST" action="">
    <input type="email" name="email" placeholder="Enter your email" required>
    <input type="text" name="username" placeholder="Enter your username" required>
    <input type="text" name="phone_number" placeholder="Enter your phone number" required>
    <button type="submit" name="submit">Generate OTP</button>
</form>

<!-- Form to take OTP input -->
<?php if (isset($_SESSION['otp'])): ?>
    <form method="POST" action="">
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit" name="verify_otp">Verify OTP</button>
    </form>
<?php endif; ?>

</body>
</html>
