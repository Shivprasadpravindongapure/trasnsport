<?php
// Step 1: Database connection
$servername = "localhost"; // Usually "localhost"
$username = "root"; // Database username, typically "root" in local setups
$password = ""; // Database password, empty by default on XAMPP/MAMP
$dbname = "elderly_transport"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Get form data and sanitize inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $user_name = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $phno = intval(htmlspecialchars($_POST['phno']));

    
    $password = htmlspecialchars($_POST['password']);
    
    // Step 3: Validate form inputs
    if (!empty($user_name) && !empty($email) && !empty($password)) {

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format!'); window.history.back();</script>";
            exit();
        }

        // Step 4: Check if the email already exists
        $check_email_stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $check_email_stmt->bind_param("s", $email);
        $check_email_stmt->execute();
        $check_email_result = $check_email_stmt->get_result();

        if ($check_email_result->num_rows > 0) {
            // Email already exists, show an alert
            echo "<script>alert('User already exists with this email!'); window.history.back();</script>";
            exit();
        }

        // Step 5: Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Step 6: Prepare SQL statement to insert the data
        $stmt = $conn->prepare("INSERT INTO users (username, email, password,phno) VALUES (?, ?, ?,?)");
        $stmt->bind_param("sssi", $user_name, $email, $hashed_password, $phno);


        // Step 7: Execute the query and check for success
        if ($stmt->execute()) {
            echo "<script>
                alert('Registration successful!');
                window.location.href = 'signin.php';
            </script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Step 8: Close the statement
        $stmt->close();
        $check_email_stmt->close();
    } else {
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
    }
}

// Step 9: Close the database connection
$conn->close();
?>
