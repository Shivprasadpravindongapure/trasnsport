<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>User Dashboard | Transport Booking</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom styles -->
    <style>
        body {
            background: linear-gradient(to bottom, #004aad, #e6f7ff);
            font-family: 'Arial', sans-serif;
        }
        .btn-custom {
            width: 200px;
            height: 50px;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: bold;
            color: #fff;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .card {
            border: none;
            border-radius: 15px;
        }
        .card h2 {
            color: #004aad;
        }
        a.btn-primary {
            background-color: #004aad;
            border: none;
        }
        a.btn-primary:hover {
            background-color: #00317a;
        }
        a.btn-secondary {
            background-color: #ff6f00;
            border: none;
        }
        a.btn-secondary:hover {
            background-color: #e65c00;
        }
        .feature {
            font-size: 0.9rem;
            color: #555;
        }
        .icon-container {
            font-size: 2rem;
            color: #004aad;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card p-5 shadow-lg">
                    <h2 class="text-center text-3xl font-bold mb-5">Welcome to Your Dashboard</h2>
                    
                    <div class="row justify-content-center mb-4">
                        <!-- Feature Section -->
                        <div class="col-md-4 text-center">
                            <div class="icon-container">
                                <i class="bi bi-bus-front-fill"></i>
                            </div>
                            <p class="feature mt-2">Book tickets for your next journey with ease!</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="icon-container">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <p class="feature mt-2">Check your booking history anytime.</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="icon-container">
                                <i class="bi bi-currency-rupee"></i>
                            </div>
                            <p class="feature mt-2">Get transparent and fair ticket prices.</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mb-4">
                        <!-- Book Button -->
                        <a href="booking.php" class="btn btn-primary btn-custom mx-3">
                            <i class="bi bi-ticket-fill"></i> Book
                        </a>

                        <!-- History Status Button -->
                        <a href="history.php" class="btn btn-secondary btn-custom mx-3">
                            <i class="bi bi-clock-history"></i> History Status
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
