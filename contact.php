<?php include 'header.php'; 

// At the beginning of the chef.php or in the <head> section, you can add this PHP code
if (isset($_GET['success']) && $_GET['success'] == '1') {
    echo '<script>alert("Message Sent!");</script>';
    // Clear the message to prevent it from being displayed on refresh or navigation
    unset($_GET['success']);
}

?>
<main>
    <div class="container text-center">
        <h1> AJ Cuisines</h1>
    </div>
    <div class="container-sm">
        <div class="row">
            <div class="col text-center">
                <h5>Contact Info</h5>
                <br>
                <p>Email: contact@example.com</p>
                <p>Phone: (123) 456-7890</p>
            </div>
            <div class="col text-bg-light">
                <form method="post" action="functions/contact_submit.php">
                    <h5 class="text-center">Let us know how we may help</h5>
                    <br>
                    <br>
                    <div class="mb-3">
                        <label for="name" class="form-label form-required">Name</label>
                        <input type="name" class="form-control" id="name" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label form-required">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label form-required">Message</label>
                        <textarea class="form-control" id="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary text-center">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container text-center">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2164.0825730106276!2d-2.1041703234703077!3d57.152745373634396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48840e17f511f297%3A0x12f9ff32bcea171c!2sSpring%20Garden%2C%20Aberdeen!5e0!3m2!1sen!2suk!4v1712775504671!5m2!1sen!2suk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</main>
<?php include 'footer.php'; ?>