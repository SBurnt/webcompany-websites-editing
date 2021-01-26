<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

ini_set('soap.wsdl_cache_enabled', "0" );
ini_set('soap.wsdl_cache_ttl', 0); 
libxml_disable_entity_loader(false);
$wsdlUrl = "http://188.65.107.44:8888/berg-trade/berghoff.1cws";

$client = new SoapClient($wsdlUrl."?wsdl",
    array(
        'login' => "webserv",
        'password' => "*%YYuFIZ0!~",
        'soap_version' => SOAP_1_2,
        'cache_wsdl' => WSDL_CACHE_NONE,
        'trace' => true,
        'exceptions' => 1,
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'verifypeer' => false,
        'verifyhost' => false,
        'stream_context' => stream_context_create(array(
                'ssl' => array(
                    'ciphers' => 'RC4-SHA',
                    'verify_peer' => false,
                    'verify_peer_name' => false
                )
            ))
        // 'location' => $wsdlUrl."?wsdl",
        // 'compression' => SOAP_COMPRESSION_ACCEPT,
        // 'uri' => "http://188.65.107.44",
        // 'features' => SOAP_USE_XSI_ARRAY_TYPE
    )
);

/*
//Заполним массив передаваемых параметров 
        $ParametrStroka = 'TestStroka';
        $params["ParametrStroka"] = $ParametrStroka;

//Выполняем операцию
        $result = $client->ExampleMethod($params); //ExampleMethod - это метод веб-сервиса 1С, который описан в конфигурации.

//Обработаем возвращаемый результат

        $jsResult = $result->return;
        $dataResult = json_decode($jsResult);
        $StatusResult = $dataResult->Status; //получим значение параметра Status, который был сформирован при ответе веб-сервиса 1С
        $MessageResult = $dataResult->Message; //получим значение параметра Message, который был сформирован при ответе веб-сервиса 1С
        
echo "<pre>".print_r($result,1)."</pre>";
*/

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>