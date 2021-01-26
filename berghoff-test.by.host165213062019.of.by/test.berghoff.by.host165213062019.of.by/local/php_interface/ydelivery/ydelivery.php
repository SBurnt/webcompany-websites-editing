<?
class PYDELIVERYModuleMain{
    
    private $options;
    private $arUrls = [
            "autocomplete" => "https://delivery.yandex.ru/api/last/autocomplete",
            "getIndex" => "https://delivery.yandex.ru/api/last/getIndex",
            "getDeliveries" => "https://delivery.yandex.ru/api/last/getDeliveries",
            "searchDeliveryList" => "https://delivery.yandex.ru/api/last/searchDeliveryList"
        ];

    function __construct($JSONkeys, $JSONopt){
        $arKeys = json_decode($JSONkeys,true);
        $arOpt = json_decode($JSONopt,true);
        if(!is_array($arKeys) || !is_array($arOpt)){
            trigger_error('The class ' . get_called_class() . ' get invalid parameters.', E_USER_ERROR);
        }
        
        $this->options = [
            "METHOD_KEYS" => $arKeys,
            "IDENTITIES" => $arOpt
        ];
    }
    
    public function cURL($url, $p){
        $ch =  curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);    
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        // curl_setopt($ch, CURLOPT_REFERER, 'http://'.$_SERVER["SERVER_NAME"].'/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);    
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded"));
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($p));
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        if ($result){
            return array("RESULT" => $result, "HEADERS" => $info);
        }else{
            return '';
        }
    }

    public function getPostValues($data){
        if (!is_array($data)) return $data;    
        ksort($data);    
        return join('', array_map(function($k)
                {
                  return $this->getPostValues($k);
                }, 
            $data));
    }
    
    public function autocomplete($term, $type = "locality", $locality_name = false){
        $METHOD_NAME = debug_backtrace()[0]["function"];
        $arData = [
                'client_id' => $this->options["IDENTITIES"]["client"]["id"],
                'sender_id' => $this->options["IDENTITIES"]["senders"][0]["id"],
                'term' => $term,
                'type' => $type
            ];
        if($locality_name)$arData["locality_name"] = $locality_name;
        $methodKey = $this->options["METHOD_KEYS"][$METHOD_NAME];
        $arData['secret_key'] = md5($this->getPostValues($arData) . $methodKey);
        $res = $this->cURL($this->arUrls[$METHOD_NAME], $arData);
        
        return json_decode($res["RESULT"],true);
    }
    
    public function getIndex($address){
        $METHOD_NAME = debug_backtrace()[0]["function"];
        $arData = [
                'client_id' => $this->options["IDENTITIES"]["client"]["id"],
                'sender_id' => $this->options["IDENTITIES"]["senders"][0]["id"],
                'address' => $address,
            ];
        $methodKey = $this->options["METHOD_KEYS"][$METHOD_NAME];
        $arData['secret_key'] = md5($this->getPostValues($arData) . $methodKey);
        $res = $this->cURL($this->arUrls[$METHOD_NAME], $arData);
        return json_decode($res["RESULT"],true);
    }
    
    public function getDeliveries($type = "fulfillment"){
        $METHOD_NAME = debug_backtrace()[0]["function"];
        $arData = [
                'client_id' => $this->options["IDENTITIES"]["client"]["id"],
                'sender_id' => $this->options["IDENTITIES"]["senders"][0]["id"],
                'type' => $type
            ];
        $methodKey = $this->options["METHOD_KEYS"][$METHOD_NAME];
        $arData['secret_key'] = md5($this->getPostValues($arData) . $methodKey);
        $res = $this->cURL($this->arUrls[$METHOD_NAME], $arData);
        
        return json_decode($res["RESULT"],true);
    }
    
    public function searchDeliveryList($city_to, $delivery_type = "todoor"){ // "todoor" / "pickup" / "post"
        $METHOD_NAME = debug_backtrace()[0]["function"];
        $arData = [
                'client_id' => $this->options["IDENTITIES"]["client"]["id"],
                'sender_id' => $this->options["IDENTITIES"]["senders"][0]["id"],
                'city_from' => "Москва",
                'city_to' => $city_to,
                'delivery_type' => $delivery_type,
                'index_city' => "",
                'weight' => 1,
                'length' => 10,
                'width' => 10,
                'height' => 10
            ];
        $methodKey = $this->options["METHOD_KEYS"][$METHOD_NAME];
        $arData['secret_key'] = md5($this->getPostValues($arData) . $methodKey);
        $res = $this->cURL($this->arUrls[$METHOD_NAME], $arData);
        
        return json_decode($res["RESULT"],true);
    }
}