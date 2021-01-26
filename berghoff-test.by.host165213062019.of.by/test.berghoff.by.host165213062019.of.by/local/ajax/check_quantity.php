<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

function cURL($url, $username, $password, $p){
    $ch =  curl_init();
    $headers = [
        'Content-Type: text/xml',
        'Connection: Keep-Alive',
        'Keep-Alive: 300',
        'Authorization: Basic '. base64_encode($username.":".$password)
    ];
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($process, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
    curl_setopt($process, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM); // CURLAUTH_BASIC, CURLAUTH_ANY, CURLAUTH_DIGEST, CURLAUTH_GSSNEGOTIATE, CURLAUTH_NTLM, CURLAUTH_ANY, and CURLAUTH_ANYSAFE.
    // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    
    //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    //curl_setopt($ch, CURLOPT_REFERER, 'http://'.$_SERVER["SERVER_NAME"].'/');
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    if ($p) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
    }
    $result = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    if ($result){
        return array("RESULT" => $result, "HEADERS" => $info);
    }else{
        return '';
    }
}

$wsdlUrl = "http://188.65.107.44:8888/berg-trade/berghoff.1cws";
$result = cURL($wsdlUrl."?wsdl", "webserv", "*%YYuFIZ0!~", false);

echo "<pre>".print_r($result,1)."</pre>";

echo "<hr><br><hr><br><hr><br>";

$option = array(
        //'location' => $wsdlUrl."?wsdl",
        'login' => "webserv",
        'password' => "*%YYuFIZ0!~",
        'bgbgbg' => 'Fuuuck!',
        'authentication' => SOAP_AUTHENTICATION_DIGEST, // SOAP_AUTHENTICATION_BASIC,
        'soap_version' => SOAP_1_2,
        'cache_wsdl' => WSDL_CACHE_NONE,
        'trace' => 1,
        'exceptions' => 1,
        'features' => SOAP_SINGLE_ELEMENT_ARRAYS, //SOAP_USE_XSI_ARRAY_TYPE, SOAP_WAIT_ONE_WAY_CALLS
        'keep_alive' => 1,
        'user_agent' => "Mozilla/5.0 (iPad; CPU OS 11_0 like Mac OS X) AppleWebKit/604.1.34 (KHTML, like Gecko) Version/11.0 Mobile/15A5341f Safari/604.1",
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'verifypeer' => false,
        'verifyhost' => false,
        'stream_context' => stream_context_create(array('ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false)))
        //'stream_context' => stream_context_create(array('http' => array('user_agent' => 'PHPSoapClient'))),
        // 'compression' => SOAP_COMPRESSION_ACCEPT,
        // 'uri' => "http://188.65.107.44",
        // 'features' => SOAP_USE_XSI_ARRAY_TYPE
    );
$client = new SoapClient($wsdlUrl."?wsdl");
$results = $client->Get(array('request'=>array('CustomerId'=>'1234')));

echo "<pre>".print_r($results,1)."</pre>";







require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>