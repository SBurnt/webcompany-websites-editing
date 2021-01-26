<?php
$to      = 'boss1991s@gmail.com';
$subject = 'Тестовое письмо';
$message = 'Тестовое письмо на русском языке.';
$headers = 'From: info@gildia-sommelier.com' . "\r\n" .
    'Reply-To: info@gildia-sommelier.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

var_dump(mail($to, $subject, $message, $headers));
?>