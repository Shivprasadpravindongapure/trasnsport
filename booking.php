<?php 
$title = "Booking"; 
$activePage = 'booking';
include 'header1.php'; 
?>

<!-- Booking Section -->
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="text-center text-primary mb-4">Book Your Ride</h2>
        <div class="card shadow-lg">
            <div class="card-body">
                <form action="booking_process.php" method="POST" id="booking-form">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="pickup_location" class="form-label">Pick-up Location</label>
                            <select class="form-control" id="pickup_location" name="pickup_location" required>
                                <option value="" disabled selected>Select Pick-up Location</option>
                                <option value="Latur">Latur</option>
                                <option value="Jalgaon">Jalgaon</option>
                                <option value="Bhuswal">Bhuswal</option>
                                <option value="Dhule">Dhule</option>
                                <option value="Sambhaji Nagar">Sambhaji Nagar</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="dropoff_location" class="form-label">Drop-off Location</label>
                            <select class="form-control" id="dropoff_location" name="dropoff_location" required>
                                <option value="" disabled selected>Select Drop-off Location</option>
                                <option value="Latur">Latur</option>
                                <option value="Jalgaon">Jalgaon</option>
                                <option value="Bhuswal">Bhuswal</option>
                                <option value="Dhule">Dhule</option>
                                <option value="Sambhaji Nagar">Sambhaji Nagar</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="ticket_price" class="form-label">Ticket Price</label>
                            <input type="text" id="ticket_price_display" class="form-control" placeholder="₹0.00" readonly>
                            <input type="hidden" id="ticket_price" name="ticket_price"> <!-- Hidden field for submission -->
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="date" class="form-label">Travel Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="time" class="form-label">Travel Time</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5 py-2">Book Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    const pickupDropdown = document.getElementById("pickup_location");
    const dropoffDropdown = document.getElementById("dropoff_location");
    const ticketPriceField = document.getElementById("ticket_price");
    const ticketPriceDisplayField = document.getElementById("ticket_price_display");

    pickupDropdown.addEventListener("change", fetchTicketPrice);
    dropoffDropdown.addEventListener("change", fetchTicketPrice);

    function fetchTicketPrice() {
        const pickup = pickupDropdown.value;
        const dropoff = dropoffDropdown.value;

        if (pickup && dropoff && pickup !== dropoff) {
            fetch(`fetch_price.php?pickup=${pickup}&dropoff=${dropoff}`)
                .then(response => response.json())
                .then(data => {
                    ticketPriceDisplayField.value = `₹${data.price}`;
                    ticketPriceField.value = data.price; // Update hidden field for submission
                })
                .catch(error => {
                    console.error("Error fetching ticket price:", error);
                    ticketPriceDisplayField.value = "Error";
                    ticketPriceField.value = "";
                });
        } else if (pickup === dropoff) {
            ticketPriceDisplayField.value = "Invalid Selection";
            ticketPriceField.value = "";
        } else {
            ticketPriceDisplayField.value = "₹0.00";
            ticketPriceField.value = "";
        }
    }
</script>

<footer class="bg-dark text-white text-center py-3">
    <p>OLDER AGE PEOPLE TRANSPORT FACILITY</p>
</footer>
