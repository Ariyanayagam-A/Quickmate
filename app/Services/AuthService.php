<?php
namespace App\Services;

class AuthService
{
    public function __construct()
    {

    }

    public function loginService($loginData)
    {
        $this->cURLHttpClient('POST','https://sso.kloudstacks.com/api/v1/auth/login', [
            'client_id' => 'admin-cli',
            'username' => $loginData['name_email'],
            'password' => $loginData['password'],
            'grant_type' => 'password',
        ], 'application/json',['authkey']);
    }

private function cURLHttpClient($method, $url, $data = [], $contentType = 'application/json', $headers = [],$type=null)
   {
    $curl = curl_init();


    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    // Handle different request methods
    switch (strtoupper($method)) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, ($contentType === 'application/json') ? json_encode($data) : http_build_query($data));
            break;
        case "GET":
            if (!empty($data)) {
                $url .= '?' . http_build_query($data);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_URL, $url);
            }
            break;
        case "PUT":
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_POSTFIELDS, ($contentType === 'application/json') ? json_encode($data) : http_build_query($data));
            break;
    }

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // Handle errors
    if ($response === false) {
        return ['error' => curl_error($curl)];
    }

    curl_close($curl);

    return ['status_code' => $httpCode, 'response' => json_decode($response, true) ?? $response];
  }

}


?>
