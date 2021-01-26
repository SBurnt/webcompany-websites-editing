<?php

if (empty($_POST['g-recaptcha-response'])) {
  exit('Empty captcha');
}
require "SendMail.php";

$url = 'https://www.google.com/recaptcha/api/siteverify';
$secret = '6LcpJP0UAAAAAGnX8D7GcdPdCKs4KiiQJxeXp6TH';
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
  // new \FlexMedia\SendMail($_REQUEST, array("send_to" => "zip2004zip@mail,", "subject" => "Заполнена_форма"));
  new \FlexMedia\SendMail($_REQUEST, array("send_to" => "gs@sbsfood.by", "subject" => "Заполнена_форма"));
} else {
  exit('Error');
}
