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
    $wsdlUrl = "http://188.65.107.44:8888/berg-trade/berghoff.1cws?wsdl";
    $SoapUserName = "webserv";
    $SoapPassword ="*%YYuFIZ0!~";
    
    $soapClientOptions = array(
        'login'=>$SoapUserName,
        'password'=>$SoapPassword,
        'stream_context' => $context,
        'cache_wsdl' => WSDL_CACHE_NONE,
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

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>