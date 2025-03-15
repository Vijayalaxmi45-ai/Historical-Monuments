<?php
// Initialize error message variable
$errorMessage = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate the form data
    if (empty($name) || empty($email) || empty($message)) {
        $errorMessage = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Please enter a valid email address.';
    } else {
        // Define the email recipient and subject
        $to = 'your-email@example.com';  // Change this to your email address
        $subject = 'New Contact Us Message from ' . $name;

        // Compose the message
        $emailMessage = "Name: $name\n";
        $emailMessage .= "Email: $email\n\n";
        $emailMessage .= "Message:\n$message\n";

        // Set email headers
        $headers = 'From: ' . $email . "\r\n";
        $headers .= 'Reply-To: ' . $email . "\r\n";

        // Send the email
        if (mail($to, $subject, $emailMessage, $headers)) {
            $successMessage = 'Thank you for your message. We will get back to you soon!';
        } else {
            $errorMessage = 'There was an error sending your message. Please try again later.';
        }
    }
}
?>
