<?php 
    $title = "Home"; 
    $activePage = "home";
    include 'header.php'; 
?>



<!-- Features Section -->
<section id="services" class="py-5 bg-light text-center">
    <div class="container">
        <h2 class="display-5 fw-bold mb-5">Why Choose Us?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card p-4 shadow border rounded">
                    <i class="bi bi-shield-check display-3 text-primary"></i>
                    <h3 class="mt-3">Safety First</h3>
                    <p>Our drivers are trained to ensure the safest journey for seniors, every time.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 shadow border rounded">
                    <i class="bi bi-clock-history display-3 text-primary"></i>
                    <h3 class="mt-3">On-Time Service</h3>
                    <p>We value your time. Our rides are always prompt, ensuring timely pickups and drop-offs.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 shadow border rounded">
                    <i class="bi bi-heart display-3 text-primary"></i>
                    <h3 class="mt-3">Caring Staff</h3>
                    <p>Our staff are compassionate and trained to offer assistance with patience and care.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Popular Destinations Section -->
<section class="py-5 bg-white text-center">
    <div class="container">
        <h2 class="display-5 fw-bold mb-5">Popular Destinations</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="destination-card p-3 shadow border rounded">
                    <i class="bi bi-geo-alt-fill display-3 text-primary mb-3"></i>
                    <h5>Latur</h5>
                    <p class="text-muted">Known for its historical forts and temples.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="destination-card p-3 shadow border rounded">
                    <i class="bi bi-map-fill display-3 text-success mb-3"></i>
                    <h5>Jalgaon</h5>
                    <p class="text-muted">Famous for its banana plantations and vibrant culture.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="destination-card p-3 shadow border rounded">
                    <i class="bi bi-building display-3 text-warning mb-3"></i>
                    <h5>Bhuswal</h5>
                    <p class="text-muted">A railway hub with a rich history.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="destination-card p-3 shadow border rounded">
                    <i class="bi bi-tree-fill display-3 text-danger mb-3"></i>
                    <h5>Dhule</h5>
                    <p class="text-muted">Known for its beautiful landscapes and serene environment.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- CTA Section -->
<section class="cta-section py-5 bg-primary text-white text-center">
    <div class="container">
        <h2 class="display-5">Ready to Book a Ride?</h2>
        <p class="lead mt-2">Start your journey with our hassle-free booking platform.</p>
        <a href="signup.php" class="btn btn-lg btn-outline-light mt-3 px-4 py-2">Get Started Now</a>
    </div>
</section>

<?php include 'footer.php'; ?>
