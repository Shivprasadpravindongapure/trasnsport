<?php 
session_start(); // Start session to check user authentication

// Assuming the session has a user_id when logged in
if (isset($_SESSION['user_id'])) {
    // Include the database connection
    include 'conn.php'; // Assuming you have a file for database connection

    $user_id = $_SESSION['user_id'];
    
    // Initialize username as a fallback
    $username = 'User';

    // Fetch username from the database based on the logged-in user's user_id
    $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username']; // Set the username from the database
    }

    $stmt->close();
}

$title = isset($title) ? $title : 'TRANSPORT BOOKING'; 
$activePage = isset($activePage) ? $activePage : 'HOME';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> | TRANSPORT BOOKING</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <!-- Brand Logo with Icon -->
            <a class="navbar-brand fw-bold" href="bookings.php">
                <i class="bi bi-car-front-fill text-primary"></i> TRANSPORT BOOKING
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Home Link with Icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($activePage == 'home') ? 'active fw-bold' : ''; ?>" href="index.php">
                            <i class="bi bi-house-door-fill"></i> HOME
                        </a>
                    </li>
                    <!-- Contact Us Link with Icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($activePage == 'contact') ? 'active fw-bold' : ''; ?>" href="contact.php">
                            <i class="bi bi-envelope-fill"></i> CONTACT US
                        </a>
                    </li>
                    <!-- About Us Link with Icon -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($activePage == 'about') ? 'active fw-bold' : ''; ?>" href="about.php">
                            <i class="bi bi-info-circle-fill"></i> ABOUT US
                        </a>
                    </li>

                    <!-- Admin Login Link (Shown only when user is not logged in) -->
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($activePage == 'admin') ? 'active fw-bold' : ''; ?>" href="admin_login.php">
                                <i class="bi bi-shield-lock-fill"></i> ADMIN LOGIN
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Display dropdown if user is logged in -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($username); ?> <!-- Safely display username -->
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="user_index.php"><i class="bi bi-person-badge-fill"></i> Profile Info</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Other content -->
</body>
</html>
