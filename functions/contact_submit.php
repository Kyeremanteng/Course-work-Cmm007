<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign form data
    $name = strip_tags(trim($_POST['name'])); 
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST['message']));

    // Recipient email address
    $recipient = "contact@ajcuine.com";

    // Email subject
    $subject = "New contact from $name";

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $email_headers = "From: $name <$email>";

    // Sending email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Redirect back to the form page with a query parameter indicating success
        header("Location: ../contact.php?success=1");
        exit;
    } else {
        // Optional: Redirect back with an error message (or handle errors differently)
        header("Location: ../contact.php?success=0");
        exit;
    }
}
?>