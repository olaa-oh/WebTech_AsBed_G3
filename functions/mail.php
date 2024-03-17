<?php

function sendMail($to, $subject, $message, $headers) {
    return mail($to, $subject, $message, $headers);
}

?>