<?php
/**
 * Created by PhpStorm.
 * User: Rising13
 * Date: 23.10.2017
 * Time: 12:01
 */
define('MODX_API_MODE', true);
include_once $_SERVER["DOCUMENT_ROOT"] . '/manager/includes/config.inc.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/manager/includes/document.parser.class.inc.php';
$modx = new DocumentParser;
$modx->db->connect();
$modx->getSettings();
startCMSSession();


/*Функции отправки сообщения с формы на email*/
$arrayEmail = $modx->getTemplateVar('email_for_feedback', '*', 1);//Получаем email
$emailCont = $arrayEmail['value'];
define("MAIL", $emailCont);

$site_name = $modx->getConfig('site_name');
define("NAME_OF_SITE", $site_name);

//Разбор массива значений чекбокса
function options($dop)
{
    $count = count($dop);
    if ($count > 0) {
        $dop_arr = array_unique($dop);
        $a = "";
        foreach ($dop_arr as $d) {
            $a = $a . $d . "; ";
        }
        return ($a);
    }
}

/*Сообщения для модальных окон*/
function yes_val()
{
    //  функция обработки сообщения об удачной отправке;
    echo "yes";
}

function error_val()
{
    //  функция обработки сообщения об ошибке при отправке;
    echo "error";
}

function resubmission_val()
{
    //  функция обработки сообщения об ошибке при отправке;
    echo "resubmission";
}

function spam_val()
{
    //  функция обработки сообщения об ошибке при отправке;
    echo "spam";
}

//  функция отправки сообщения без отправки файлов
function mail_no_file($subject, $headers, $message, $form_nmbr)
{
    $count_s = "";
    $sess_nbr = "counter_" . $form_nmbr;
    if ($_REQUEST['email_back'] == "") {
        if (!isset($_SESSION[$sess_nbr])) { //проверка на повторную отправку
            $_SESSION[$sess_nbr] = 0;
        } else {
            $count_s = $_SESSION[$sess_nbr];
        }
        if ($count_s == $_REQUEST) {
            resubmission_val(); //вызов сообщения о попытке повторной отправки
        } else {
            $mail_client = MAIL;
            if (mail($mail_client, $subject, $message, $headers)) {
                //сообщение об удачной отправке;
                yes_val();
                $_SESSION[$sess_nbr] = $_REQUEST;
            } else {
                error_val();
            }
        }
    } else {
        //Сообщение о использовании спам-бота
        spam_val();
    }
    //file_put_contents('test.txt', $message,FILE_APPEND);
}

function mail_no_file_no_result($subject, $headers, $message, $form_nmbr)
{
    $count_s = "";
    $sess_nbr = "counter_" . $form_nmbr;
    if ($_REQUEST['email_back'] == "") {
        if (!isset($_SESSION[$sess_nbr])) { //проверка на повторную отправку
            $_SESSION[$sess_nbr] = 0;
        } else {
            $count_s = $_SESSION[$sess_nbr];
        }
        if ($count_s != $_REQUEST) {
            $mail_client = MAIL;
            if (mail($mail_client, $subject, $message, $headers)) {
                //сообщение об удачной отправке;
                $_SESSION[$sess_nbr] = $_REQUEST;
            }
        }
    }
}


/*Платежная система*/
$payment = $modx->db->escape($_REQUEST['payment']);
if ($payment === 'payment-card') {
    if ($_REQUEST['type_form'] == 7) { //проверка на наименование формы
        $form_nmbr = 7;
        $subject = "Заказ трансфера с сайта " . NAME_OF_SITE;
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: " . NAME_OF_SITE . " <robot@" . NAME_OF_SITE . ">\r\n";
        if (isset($_REQUEST['transfer_type'])) {
            switch ($_REQUEST['transfer_type']) {
                case 'a':
                    $tranf_type = 'Аэропорт и вокзал';
                    break;
                case 's':
                    $tranf_type = 'Санатории';
                    break;
                case 'e':
                    $tranf_type = 'Европа';
                    break;
                case 'c':
                    $tranf_type = 'Города Беларуси';
                    break;
            }
        }
        if (isset($_REQUEST['payment'])) {
            if ($_REQUEST['payment'] == 'payment-cash') {
                $payment = 'Наличными в авто';
            } else {
                $payment = 'Карточкой online';
            }
        }
        $message = "<html>
	<head>
	<title>Сообщение с текстом из формы Заказать трансфер к с сайта <b>&laquo;" . NAME_OF_SITE . "&raquo;</b></title>
	</head>
	<body>
	<table>
	<tr valign='top'><td>Тема сообщения:</td><td>Заказ трансфера с сайта <b>&laquo;" . NAME_OF_SITE . "&raquo;</b></td></tr>
    <tr valign='top'><td>Тип поездки:</td><td>" . $tranf_type . "</td></tr>
	<tr valign='top'><td>Откуда отправляться:</td><td>" . $_REQUEST['location'] . "</td></tr>
	<tr valign='top'><td>Куда ехать:</td><td>" . $_REQUEST['where'] . "</td></tr>
	<tr valign='top'><td>Адрес:</td><td>" . $_REQUEST['adress'] . "</td></tr>
	<tr valign='top'><td>Промежуточные точки:</td><td>" . $_REQUEST['address2'] ." ". $_REQUEST['address3'] . " " . $_REQUEST['address4'] ." " . $_REQUEST['address5'] ."</td></tr>
	<tr valign='top'><td>Номер рейса:</td><td>" . $_REQUEST['voyage_nmr'] . "</td></tr>
	<tr valign='top'><td>Дата и время поездки:</td><td>" . $_REQUEST['date'] . " в " . $_REQUEST['time_hours'] . ":" . $_REQUEST['time_mins'] . "</td></tr>
	<tr valign='top'><td>Тип автомобиля:</td><td>" . $_REQUEST['auto_type'] . "</td></tr>	

	<tr valign='top'><td>ФИО пользователя, оставившего запрос:</td><td>" . $_REQUEST['name'] . "</td></tr>
	<tr valign='top'><td>Телефон:</td><td>" . $_REQUEST['phone'] . "</td></tr>
	<tr valign='top'><td>Email:</td><td>" . $_REQUEST['email'] . "</td></tr>
	<tr valign='top'><td>Тип оплаты:</td><td>" . $payment . "</td></tr>
	<tr valign='top'><td>Стоимость в беларусских рублях:</td><td>" . $_REQUEST['price'] . "</td></tr>
	</table>";
        mail_no_file_no_result($subject, $headers, $message, $form_nmbr);
    }

    /*Функции*/
    function md5_pay($salt, $pay_arrValue)
    {
        /*генерирует контрольную сумму*/

        $delete_keys = array('payment_params_salt', 'payment_params_url', 'DelayPayment', 'SendNotification', 'Checkvalue', 'CustomerNumber', 'FORMAT');//Исключаемые параметры

        foreach ($pay_arrValue as $key => $value) {
            if (in_array($key, $delete_keys)) {
                unset($pay_arrValue[$key]);
            }
        }

        $value_str = implode(';', $pay_arrValue);
        $hash = strtoupper(md5(strtoupper(md5($salt) . md5($value_str))));
        return $hash;
    }

    /*Получаем параметры платежной системы*/
    $payment_params_arr = array('payment_params_mid', 'payment_params_login', 'payment_params_password', 'payment_params_salt', 'payment_params_url');//Список конфигурационных параметром

    $payment_params_def = array('payment_params_mid' => '481311', 'payment_params_login' => 'taxitransfer', 'payment_params_password' => '23072007g', 'payment_params_salt' => 'Секретное слово', 'payment_params_url' => 'https://test.paysec.by/');//Значения по умолчанию

    $payment_params_comparison = array('payment_params_mid' => 'Merchant_ID', 'payment_params_login' => 'Login', 'payment_params_password' => 'Password', 'payment_params_salt' => 'payment_params_salt', 'payment_params_url' => 'payment_params_url');//Значения ключей для замены

    $config_page_id = 99; //id страницы с конфигурацией

    $payment_val_arr = $modx->getTemplateVars($payment_params_arr, 'name', $config_page_id);
    $payment_params = array();

    foreach ($payment_val_arr as $payment_arr_val) {
        $payment_val = $payment_arr_val['value'];
        if ($payment_val == "" or is_null($payment_val)) {
            $payment_val = $payment_params_def[$payment_arr_val['name']];
        }
        $payment_params[$payment_params_comparison[$payment_arr_val['name']]] = $payment_val;
    }

    /*Задание параметров для платежной системы*/
    $location_val = $modx->db->escape($_REQUEST['location']);
    $where_val = $modx->db->escape($_REQUEST['where']);

    $payment_params['Bill'] = mktime();
    $payment_params['Bill_amount'] = $modx->db->escape($_REQUEST['price']);
    $payment_params['Bill_currency'] = 'BYN';
    $payment_params['Bill_comment'] = "Заказ трансфера. Начальная точка - {$location_val}. Конечная - {$where_val}";
    $payment_params['Customer_Name'] = $modx->db->escape($_REQUEST['name']);
    $payment_params['Customer_Lastname'] = '';
    $payment_params['Customer_Middlename'] = '';
    $payment_params['Customer_Email'] = $modx->db->escape($_REQUEST['email']);
    $payment_params['Customer_Phone'] = '';
    $payment_params['Customer_Mobile'] = $modx->db->escape($_REQUEST['phone']);
    $payment_params['Language'] = 'RU';
    $payment_params['Pay_until'] = '';
    $payment_params['DelayPayment'] = '0';
    $payment_params['SendNotification'] = '1';
    $payment_params['Checkvalue'] = md5_pay($payment_params['payment_params_salt'], $payment_params);
    $payment_params['CustomerNumber'] = '';
    $payment_params['FORMAT'] = '3';


    //Построим строку для POST-запроса
    $poststring = "";

    foreach ($payment_params AS $key => $val) {
        if (!in_array($key, array('payment_params_salt', 'payment_params_url'))) {
            $poststring .= urlencode($key) . "=" . urlencode($val) . "&";
        }
    }
    // Убрать последний амперсант
    $poststring = substr($poststring, 0, -1);

    $url = $payment_params['payment_params_url'] . 'bill/createbill.cfm';

    file_put_contents('url-log.txt', $url);
    file_put_contents('data-log.txt', $poststring);

    if (function_exists("curl_init")) {
        $CR = curl_init();
        curl_setopt($CR, CURLOPT_URL, $url);
        curl_setopt($CR, CURLOPT_POST, 1);
        curl_setopt($CR, CURLOPT_FAILONERROR, true);
        curl_setopt($CR, CURLOPT_POSTFIELDS, $poststring);
        curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, 0);

        $the_payment_form = curl_exec($CR);

        $the_error = curl_error($CR);
        if ($the_error) {
            $error = $the_error;
        }
        curl_close($CR);
    } else {
        $error = "error: curl_init doesn't exist";
    }

    if (isset($error) && $error) {
        $output = $error;
        return;
    }
    file_put_contents('output-log.txt', $the_payment_form);
    echo $the_payment_form;
} else {
    if ($_REQUEST['type_form'] == 7) { //проверка на наименование формы
        $form_nmbr = 7;
        $subject = "Заказ трансфера с сайта " . NAME_OF_SITE;
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: " . NAME_OF_SITE . " <robot@" . NAME_OF_SITE . ">\r\n";
        if (isset($_REQUEST['transfer_type'])) {
            switch ($_REQUEST['transfer_type']) {
                case 'a':
                    $tranf_type = 'Аэропорт и вокзал';
                    break;
                case 's':
                    $tranf_type = 'Санатории';
                    break;
                case 'e':
                    $tranf_type = 'Европа';
                    break;
                case 'c':
                    $tranf_type = 'Города Беларуси';
                    break;
            }
        }
        if (isset($_REQUEST['payment'])) {
            if ($_REQUEST['payment'] == 'payment-cash') {
                $payment = 'Наличными в авто';
            } else {
                $payment = 'Карточкой online';
            }
        }
        $message = "<html>
	<head>
	<title>Сообщение с текстом из формы Заказать трансфер к с сайта <b>&laquo;" . NAME_OF_SITE . "&raquo;</b></title>
	</head>
	<body>
	<table>
	<tr valign='top'><td>Тема сообщения:</td><td>Заказ трансфера с сайта <b>&laquo;" . NAME_OF_SITE . "&raquo;</b></td></tr>
    <tr valign='top'><td>Тип поездки:</td><td>" . $tranf_type . "</td></tr>
	<tr valign='top'><td>Откуда отправляться:</td><td>" . $_REQUEST['location'] . "</td></tr>
	<tr valign='top'><td>Куда ехать:</td><td>" . $_REQUEST['where'] . "</td></tr>
	<tr valign='top'><td>Адрес:</td><td>" . $_REQUEST['adress'] . "</td></tr>
	<tr valign='top'><td>Промежуточные точки:</td><td>" . $_REQUEST['address2'] ." ". $_REQUEST['address3'] . " " . $_REQUEST['address4'] ." " . $_REQUEST['address5'] ."</td></tr>
	<tr valign='top'><td>Номер рейса:</td><td>" . $_REQUEST['voyage_nmr'] . "</td></tr>
	<tr valign='top'><td>Дата и время поездки:</td><td>" . $_REQUEST['date'] . " в " . $_REQUEST['time_hours'] . ":" . $_REQUEST['time_mins'] . "</td></tr>
	<tr valign='top'><td>Тип автомобиля:</td><td>" . $_REQUEST['auto_type'] . "</td></tr>	

	<tr valign='top'><td>ФИО пользователя, оставившего запрос:</td><td>" . $_REQUEST['name'] . "</td></tr>
	<tr valign='top'><td>Телефон:</td><td>" . $_REQUEST['phone'] . "</td></tr>
	<tr valign='top'><td>Email:</td><td>" . $_REQUEST['email'] . "</td></tr>
	<tr valign='top'><td>Тип оплаты:</td><td>" . $payment . "</td></tr>
	<tr valign='top'><td>Стоимость в беларусских рублях:</td><td>" . $_REQUEST['price'] . "</td></tr>
	</table>";
        mail_no_file($subject, $headers, $message, $form_nmbr);
    }
}