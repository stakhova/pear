<?php

class Reatech_Integration
{
    public static function init()
    {

    }

    public static function get_authorization_token() {
        $url = "https://api.reteach.io/oauth/authorize";
    
        $data = [
            "grant_type" => "authorization_code",
            "code" => '18ff45f58310d1eb',
            "client_secret" => '233607fc12c819406edb2864c6c9b8c9',
            "client_id" => '5d285d79-b3dd-4824-a2bd-e0e262bb5948',
        ];
    
        $headers = [
            "Content-Type: application/json",
        ];
    
        $ch = curl_init($url);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
        $response = curl_exec($ch);
    
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }
    
        curl_close($ch);
        
        $response_array = json_decode($response, true);
        $access_token = $response_array['access_token'];
        
        return $access_token;
    }
    
    public static function create_user($userData) {
        $accessToken = self::get_authorization_token();
        $url = "https://api.reteach.io/customer";
    
        $headers = [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json",
        ];
    
        $ch = curl_init($url);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
    
        $response = curl_exec($ch);
    
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }
    
        curl_close($ch);
    
        var_dump(json_decode($response, true));die;
    }
    
}
