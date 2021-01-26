<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
require($_SERVER["DOCUMENT_ROOT"]."/quant/vendor/autoload.php");
// Изменил оригинальный файл вендорв
// /matejsvajger/ntlm-soap-client/src/NTLMSoap/Common/NTLMConfig.php : 42

$url = 'http://188.65.107.44:8888/berg-trade/berghoff.1cws?wsdl';
$config = new matejsvajger\NTLMSoap\Common\NTLMConfig([
    'domain'   => '188.65.107.44',
    'username' => 'webserv',
    'password' => '*%YYuFIZ0!~'
]);

$client = new matejsvajger\NTLMSoap\Client($url, $config);

/*
Типы и функции SOAP-Сервера
echo "<pre>".print_r($client->__getFunctions(),1)."</pre>";
echo "<pre>".print_r($client->__getTypes(),1)."</pre>";
*/

$parameters["Articl"] = "";
$response = $client->Ostatok($parameters); //$parameters

$arStocks = $response->return->Состав;
echo "Ostatok = <pre>".print_r($arStocks,1)."</pre>";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>