<?php

namespace matejsvajger\NTLMSoap\Model\Traits;

use matejsvajger\NTLMSoap\Common\NTLMConfig;

trait NTLMRequest
{
    /**
     * Replaces native php \SoapClient function and sends
     * request with NTLM Authentication headers to NAT
     * server.
     *
     * @author Matej Svajger <hello@matejsvajger.com>
     * @version 1.0
     * @date    2016-11-15
     */
    public function __doRequest($request, $location, $action, $version, $one_way = null)
    {
        $auth = NTLMConfig::getAuthString();
        
        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
                            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                              <soap:Body>
                                <GetItemPrice xmlns="http://connecting.website.com/WSDL_Service">
                                  <PRICE>'.$dataFromTheForm.'</PRICE> 
                                </GetItemPrice >
                              </soap:Body>
                            </soap:Envelope>';   // data from the form, e.g. some ID number

        $headers = [
            'Method: POST',
            'Connection: Keep-Alive',
            'User-Agent: PHP-SOAP-CURL',
            'Content-type: text/xml;charset="utf-8"',
            'Accept: text/xml',
            'Cache-Control: no-cache',
            'Pragma: no-cache',
            'SOAPAction: "Ostatok"',
            // "Content-length: ".strlen($xml_post_string)
            //'SOAPAction: http://connecting.website.com/WSDL_Service/GetPrice',
            //'Content-Type: text/xml; charset=utf-8',
            // 'SOAPAction: "'.$action.'"',
            
        ];

        $this->__last_request_headers = $headers;
        $this->__last_request = $request;
        
        $wsdlUrl = "http://188.65.107.44:8888/berg-trade/berghoff.1cws?wsdl";

        $ch = curl_init($wsdlUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_URL, $wsdlUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_USERPWD, $auth);
        
        $auth = NTLMConfig::getAuthString();

        $this->ch = curl_init($path);

        echo "START";
        echo "location=".$location."<br>";
        echo "headers=<pre>".print_r($headers,1)."</pre>";
        echo "request=<pre>".print_r($request,1)."</pre>";
        echo "auth=$auth<br>";

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);

        
        echo "STOP<br>";
        echo "response=<pre>".print_r($response,1)."</pre><br>";
        echo "info=<pre>".print_r($info,1)."</pre><br>";
        /*
        die("VV");
        */
        
        return $response;
    }
}
