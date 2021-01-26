<?php

if (empty($_POST['g-recaptcha-response'])) {
  exit('Empty captcha');
}

$url = 'https://www.google.com/recaptcha/api/siteverify';
$secret = '???????????????????????????';
$recaptcha = $_POST['g-recaptcha-response'];
$ip = $_SERVER['REMOTE_ADDR'];
$url_data = $url . '?secret=' . $secret . '&response=' . $recaptcha . '&remoteip=' . $ip;
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url_data);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$res = curl_exec($curl);
curl_close($curl);

$res = json_decode($res);

if ($res->success) {
  $answer = isset($_POST['feedback-up-answer']) ? $_POST['feedback-up-answer'] : '';

  $mes = "<p>Ответ: $answer</p>";
  $to = "zip2004zip@mail.ru";
  $sub = "=?utf-8?B?" . base64_encode("Ответ с фуд") . '?=';
  $headers = "Content-type: text/html; charset=utf-8 \r\n";
  $headers .= "From: foot.by/\r\n";

  mail("$to", "$sub", "$mes", "$headers");
  echo '1';
} else {
  exit('Error');
}
