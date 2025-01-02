<?php 
    $title = "Contact Us"; 
    $activePage = "contact";
    include 'header.php'; 

    // Include database connection
    include 'conn.php';

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];
        $message = $_POST['message'];

        // Prepare SQL to insert data into the contact table
        $sql = "INSERT INTO contact (name, email, contact_no, message) VALUES (?, ?, ?, ?)";

        // Use prepared statements to prevent SQL injection
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $name, $email, $contact_no, $message);

            // Execute the query and check for success
            if ($stmt->execute()) {
                $success = "Thank you for contacting us! We will get back to you soon.";
            } else {
                $error = "Error: Could not submit your message. Please try again.";
            }

            // Close the statement
            $stmt->close();
        } else {
            $error = "Error preparing statement: " . $conn->error;
        }

        // Close the connection
        $conn->close();
    }
?>

<!-- Contact Us Content -->
<section class="contact-section text-center">
    <div class="container">
        <h1 class="display-4">CONTACT US </h1>
        <p class="lead">Reach out to us for any inquiries..............</p>

        <!-- Display success or error message -->
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Contact Form -->
        <form action="contact.php" method="POST" class="mt-4" style="max-width: 600px; margin: auto;">
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group mb-3">
                <label for="contact_no">Contact Number</label>
                <input type="text" class="form-control" id="contact_no" name="contact_no" required>
            </div>
            <div class="form-group mb-3">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>