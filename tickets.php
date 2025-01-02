<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Include the database connection
    include 'conn.php'; // Database connection file

    $user_id = $_SESSION['user_id'];

    // Query to fetch ticket details for the logged-in user
    $sql = "SELECT bookings.id, bookings.name, bookings.pickup_location, bookings.dropoff_location, bookings.date, bookings.time, bookings.price, users.username 
            FROM bookings 
            INNER JOIN users ON bookings.username = users.username
            WHERE users.id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Include Bootstrap CSS
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';

    echo '<div class="container mt-5">';
    echo '<h2 class="text-center mb-4 font-weight-bold text-primary">Your Tickets</h2>';

    if ($result->num_rows > 0) {
        echo '<div class="row justify-content-center">';

        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-8 mb-4">';
            echo '  <div class="card border border-primary rounded shadow-sm">';
            echo '      <div class="card-body">';
            echo '          <div class="d-flex justify-content-between align-items-center mb-3">';
            echo '              <h5 class="card-title text-primary">Ticket ID: ' . $row['id'] . '</h5>';
            echo '              <span class="badge bg-success">Confirmed</span>';
            echo '          </div>';
            echo '          <div class="row">';
            echo '              <div class="col-md-6 mb-2">';
            echo '                  <p class="mb-1"><strong>Passenger Name:</strong></p>';
            echo '                  <p>' . $row['name'] . '</p>';
            echo '              </div>';
            echo '              <div class="col-md-6 mb-2">';
            echo '                  <p class="mb-1"><strong>Travel Date:</strong></p>';
            echo '                  <p>' . $row['date'] . '</p>';
            echo '              </div>';
            echo '              <div class="col-md-6 mb-2">';
            echo '                  <p class="mb-1"><strong>Pickup Location:</strong></p>';
            echo '                  <p>' . $row['pickup_location'] . '</p>';
            echo '              </div>';
            echo '              <div class="col-md-6 mb-2">';
            echo '                  <p class="mb-1"><strong>Dropoff Location:</strong></p>';
            echo '                  <p>' . $row['dropoff_location'] . '</p>';
            echo '              </div>';
            echo '              <div class="col-md-6 mb-2">';
            echo '                  <p class="mb-1"><strong>Travel Time:</strong></p>';
            echo '                  <p>' . $row['time'] . '</p>';
            echo '              </div>';
            echo '              <div class="col-md-6 mb-2">';
            echo '                  <p class="mb-1"><strong>Price:</strong></p>';
            echo '                  <p class="text-success font-weight-bold">₹' . number_format($row['price'], 2) . '</p>';
            echo '              </div>';
            echo '          </div>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo '<div class="alert alert-info text-center" role="alert">No tickets found for your account.</div>';
    }

    echo '</div>';

    $stmt->close();
} else {
    echo '<div class="alert alert-warning text-center" role="alert">Please log in to view your tickets.</div>';
}

$conn->close();
?>

