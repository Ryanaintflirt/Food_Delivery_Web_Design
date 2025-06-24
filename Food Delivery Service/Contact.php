<?php
include "header.php";
include "dbConnect.php";

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate input
    if (empty($full_name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
        $error_message = "Please fill in all fields";
    } else {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO contacts (full_name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full_name, $email, $phone, $subject, $message);
        
        if ($stmt->execute()) {
            $success_message = "Your message has been sent successfully! We'll get back to you soon.";
        } else {
            $error_message = "Error sending message: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<style>
    .contact-section {
        padding: 50px 0;
        background-color: #f9f9f9;
    }
    .contact-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .contact-form {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    .form-group textarea {
        height: 150px;
        resize: vertical;
    }
    .submit-btn {
        background-color: #4CAF50;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }
    .submit-btn:hover {
        background-color: #45a049;
    }
    .message {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<section class="contact-section">
    <div class="contact-container">
        <h2 class="text-center">Contact Us</h2>
        <p class="text-center">Have a question or feedback? We'd love to hear from you!</p>

        <?php if ($success_message): ?>
            <div class="message success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="message error">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form class="contact-form" method="POST" action="">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>
</section>

<?php
$conn->close();
include "footer.php";
?>