<?php
class Curl extends CComponent{
    public static function getContent($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//В большенстве случаев помогает, если используется https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//В большенстве случаев помогает, если используется https
        return curl_exec($ch);
    }

    public static function sendContent($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//В большенстве случаев помогает, если используется https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//В большенстве случаев помогает, если используется https
        return curl_exec($ch);
    }

    public static function sendJSON($url,$json){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//В большенстве случаев помогает, если используется https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//В большенстве случаев помогает, если используется https
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json))
        );
        return curl_exec($ch);
    }
}