<?php
// util/email.php

function send_order_confirmation($to, $subject, $body) {
    // Set content-type header for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: Book Shop <your_email@example.com>' . "\r\n";

    // Send email
    if(mail($to, $subject, $body, $headers)) {
        return true;
    } else {
        return false;
    }
}
?>
