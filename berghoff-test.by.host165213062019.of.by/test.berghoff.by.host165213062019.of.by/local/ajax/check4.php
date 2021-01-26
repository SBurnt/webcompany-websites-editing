<?
function Connect1C(){
    if (!function_exists('is_soap_fault')){
      print 'Не настроен web сервер. Не найден модуль php-soap.';
      return false;
    }
    try {
      $client = new SoapClient('http://188.65.107.44:8888/berg-trade/berghoff.1cws?wsdl',
                               array('login'          => 'webserv',
                                     'password'       => '*%YYuFIZ0!~',
                                     'soap_version'   => SOAP_1_2,
                                     'cache_wsdl'     => WSDL_CACHE_NONE,
                                     'exceptions'     => true,
                                     'trace'          => 1));
    }catch(SoapFault $e) {
      trigger_error('Ошибка подключения или внутренняя ошибка сервера. Не удалось связаться с базой 1С.', E_ERROR);
      echo "<pre>".print_r($e,1)."</pre>";
    }
    //echo 'Раз';
    if (is_soap_fault(Клиент1С)){
      trigger_error('Ошибка подключения или внутренняя ошибка сервера. Не удалось связаться с базой 1С.', E_ERROR);
      return false;
    }
    return $client;
  }
 
  function GetData($idc, $txt){
      if (is_object($idc)){
 
        try {
          $par = array('zapros' => $txt);
          //var_dump($par);
          $ret1c = $idc->hellobaza($par);
        } catch (SoapFault $e) {
                      echo "АЩИБКА!!! </br>";
            var_dump($e);
        }   
      }
      else{
        echo 'Не удалося подключиться к 1С';
        var_dump($idc);
      }
    return $ret1c;
  }
 
  $idc = Connect1C();
  $ret1c = GetData($idc, "привет");
  //var_dump($ret1c);
  $aa=$ret1c->return;
  echo "!!$aa!!";
  ?>