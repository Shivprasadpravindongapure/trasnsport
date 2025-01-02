<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Transport Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1508050919630-b135583b29d4'); /* Transport-themed background image */
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9); /* Slight transparency for the card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for the card */
        }
        .form-label {
            font-weight: bold;
            color: #333;
        }
        .btn-primary {
            background-color: #007bff; /* Default bootstrap blue */
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
        .header-icon {
            font-size: 3rem;
            color: #007bff;
        }
        .custom-input-icon {
            position: relative;
        }
        .custom-input-icon input {
            padding-left: 40px;
        }
        .custom-input-icon i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <i class="fas fa-bus header-icon"></i> <!-- Transport icon (bus) -->
                        </div>
                        <h3 class="text-center">Sign Up</h3>

                        <!-- Display error message if exists -->
                        <?php if (isset($error_message)): ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Signup form -->
                        <form action="Sign_Up_process.php" method="POST" class="mt-4">
                            <div class="mb-3 custom-input-icon">
                                <i class="fas fa-envelope"></i> <!-- Email icon -->
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3 custom-input-icon">
                                <i class="fas fa-user"></i> <!-- Username icon -->
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3 custom-input-icon">
                                <i class="fas fa-lock"></i> <!-- Password icon -->
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 custom-input-icon">
                                <i class="fas fa-phone"></i> <!-- Phone number icon -->
                                <label for="phno" class="form-label">Phone Number</label>
                                <input type="number" class="form-control" id="phno" name="phno" required maxlength="10" min="1000000000" max="9999999999" oninput="validatePhoneNumber(this)">
                                <small id="phone-error" class="text-danger" style="display:none;">Phone number must be exactly 10 digits.</small>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </form>
                        <p class="text-center mt-3">Already have an account? <a href="signin.php">Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        // JavaScript function to validate the phone number length
        function validatePhoneNumber(input) {
            const phoneError = document.getElementById("phone-error");
            if (input.value.length !== 10) {
                phoneError.style.display = 'block'; // Show error message
            } else {
                phoneError.style.display = 'none'; // Hide error message
            }
        }
    </script>
</body>
</html>