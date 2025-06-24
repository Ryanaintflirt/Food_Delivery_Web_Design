<?php
include('dbConnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['cname']);
    $email = mysqli_real_escape_string($conn, $_POST['cemail']); // Not used in DB, but can be saved if needed
    $phone = mysqli_real_escape_string($conn, $_POST['cphone']);
    $subject = mysqli_real_escape_string($conn, $_POST['csub']);
    $message = mysqli_real_escape_string($conn, $_POST['msg']);

    $sql = "INSERT INTO feedback (customer_name, email, Phone, Subject, message) VALUES ('$name', '$email', '$phone', '$subject', '$message')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Message submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Good Food</title>
</head>
<style>
        .map-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
    </style>
<body>
<?php
include "header.php";
?>
<!-- Contact Section Start -->
    <section class="contact">
        <div class="container">
            <h2 class="text-center">Get in touch</h2>
            <div class="heading-border"></div>

            <form action="" class="form">
                <fieldset>
                    <legend>Contact Us</legend>
                    <p class="label">Full Name</p>
                    <input type="text" id="cname" placeholder="Enter your name..." required>
                    <p class="label">Email</p>
                    <input type="email" id="cemail" placeholder="Enter your email..." required>
                    <p class="label">Phone Number</p>
                    <input type="contact" id="cphone" placeholder="Enter your phone..." required>
                    <p class="label">Subject</p>
                    <input type="text" id="csub" placeholder="Enter your subject..." required>
                    <p class="label">Message</p>
                    <textarea name="" id="msg" rows="5" placeholder="Enter your message..." required></textarea>
                    <input type="submit" value="Submit" class="btn-primary">
                </fieldset>
            </form>
        </div>
    </section>
    <!-- Map Section Start -->
     <section class="map">
        <h2 class="text-center">Find Us</h2>
        <div class="map-container">

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.198336321716!2d96.1654144751521!3d16.816513983976634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ecb385037f11%3A0xa4ac4eaf23262155!2sBritish%20United%20College!5e0!3m2!1sen!2smm!4v1748606024968!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"  referrerpolicy="no-referrer-when-downgrade" ></iframe>
     </section>
     <!-- Map Section End -->
    </body>
</html>
<?php
include "footer.php";
?>