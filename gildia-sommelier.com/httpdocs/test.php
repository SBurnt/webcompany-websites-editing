<?php
$to      = 'boss1991s@gmail.com';
$subject = '�������� ������';
$message = '�������� ������ �� ������� �����.';
$headers = 'From: info@gildia-sommelier.com' . "\r\n" .
    'Reply-To: info@gildia-sommelier.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

var_dump(mail($to, $subject, $message, $headers));
?>