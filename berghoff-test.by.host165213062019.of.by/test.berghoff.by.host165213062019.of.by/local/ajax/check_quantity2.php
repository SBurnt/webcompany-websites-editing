<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");


try {
    $opts = array(
        'http' => array(
            'user_agent' => 'PHPSoapClient'
        )
    );
    $context = stream_context_create($opts);

    $wsdlUrl = 'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';
    $soapClientOptions = array(
        'stream_context' => $context,
        'cache_wsdl' => WSDL_CACHE_NONE
    );

    $client = new SoapClient($wsdlUrl, $soapClientOptions);

    $checkVatParameters = array(
        'countryCode' => 'DK',
        'vatNumber' => '47458714'
    );

    $result = $client->checkVat($checkVatParameters);
    print_r($result);
}
catch(Exception $e) {
    echo $e->getMessage();
}




//phpinfo();

// $wsdlUrl = "https://elma.oldos.ru/Modules/EleWise.ELMA.Workflow.Processes.Web/WFPWebService.asmx";
$wsdlUrl = "http://188.65.107.44:8888/berg-trade/berghoff.1cws";
$SoapUserName = "webserv"; //логин пользователя от которого будет запущен процесс
$SoapPassword ="*%YYuFIZ0!~"; //пароль пользователя от которого будет запущен процесс
// ini_set("soap.wsdl_cache_enabled", "0");
// libxml_disable_entity_loader(false);


$opts = array(
    'http' => array(
        'user_agent' => 'PHPSoapClient'
    )
);
$context = stream_context_create($opts);

$wsdlUrl = 'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';
$soapClientOptions = array(
    "trace" => true,
    'login'=>$SoapUserName,
    'password'=>$SoapPassword,
    'stream_context' => $context,
    'cache_wsdl' => WSDL_CACHE_NONE
);

$client = new SoapClient($wsdlUrl."?wsdl", $soapClientOptions); 


try {

// SOAP 1.2 client
$params = array(
    'login'=>$SoapUserName,
    'password'=>$SoapPassword,
    'trace' => true
    /*
    'cache_wsdl' => 0,
    'soap_version' => SOAP_1_2,
    'stream_context' => stream_context_create(array(
          'ssl' => array(
               'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
          )
    ))
    'encoding' => 'UTF-8',
    'verifypeer' => false,
    'verifyhost' => false,
    'soap_version' => SOAP_1_2,
    'trace' => 1,
    'exceptions' => 1,
    'connection_timeout' => 180,
    'stream_context' => stream_context_create($opts)
    */
);
    
    $client = new SoapClient($wsdlUrl."?wsdl", $params);
} catch (SoapFault $e) {  
    echo "<pre>".print_r($e,1)."</pre>";
}














$data = new stdClass();
$data->Items = new stdClass();
$data->Items->WebDataItem = array(); // Формируем массив контекстных переменных. 
// Массив параметров необходимых для запуска процесса
$parameters = [
        "login" => $SoapUserName,
        "password" => $SoapPassword,
        "location"=>$wsdlUrl
    ];
$data->Items->WebDataItem[0] = array("Name"=>"Articl", "Value"=>"1108478");
// $data->Items->WebDataItem[1] = array("Name"=>"NameLead", "Value"=>iconv('Windows-1251', 'UTF-8', $_REQUEST["NAME"]));
// $parameters["data"] = $data;


// Создание SOAP-клиента по WSDL
//$client = new SoapClient($wsdlUrl."?wsdl", array("location"=>$wsdlUrl));

$client = new SoapClient($wsdlUrl."?wsdl", $parameters);

//Вызов метода Run для запуска экземпляра процесса
$zzz = $client->Run($parameters);



echo "ZZ";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>