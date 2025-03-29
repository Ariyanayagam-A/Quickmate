<?php
namespace App\Services;

class MasterAuthService
{
    protected $connection;

    public function __construct()
    {

    }

    public function loginService()
    {
        $payload  = [
            'client_id' => 'admin-cli',
            'username' => 'admin',
            'password' => 'admin',
            'grant_type' => 'password',
        ];

        //echo json_encode($payload);die;

        $endpoint = 'https://auth.kloudstacks.com/realms/master/protocol/openid-connect/token';

        $getAccessObject =  $this->cURLHttpClient('POST',$endpoint,$payload,'application/x-www-form-urlencoded');

        if($getAccessObject['status_code'] == '200' || isset($getAccessObject['response']['access_token']))
        {
           return $getAccessObject['response']['access_token'];
        }

    }

    public function createOrgRealm()
    {
        $this->createUser();
        $getAccessToken = $this->loginService();
        $endpoint = 'https://auth.kloudstacks.com/admin/realms';
        $payload  = [
            'realm' => 'Arya',
            'enabled' =>  true
        ];
        $headers = [
              'Authorization: Bearer '.$getAccessToken,
              'Content-Type: application/json'
        ];

        $realmResponse =  $this->cURLHttpClient('POST',$endpoint,$payload,'application/json',$headers,'test');

        dd($realmResponse);
    }


    public function createUser()
    {
        $getAccessToken = $this->loginService();

        $endpoint = 'https://auth.kloudstacks.com/admin/realms/Arya/users';

       $payload = [
            "username" => "Arya",
            "firstName" => "A",
            "lastName" => "T",
            "email" => "arya@yopmail.com",
            "emailVerified" => true,
            "enabled" => true,
            "credentials" => [
                [
                    "type" => "password",
                    "value" => "Arya@123",
                    "temporary" => false
                ]
            ]
        ];
        
        $headers = [
              'Authorization: Bearer '.$getAccessToken,
              'Content-Type: application/json'
        ];

        $realmResponse =  $this->cURLHttpClient('POST',$endpoint,$payload,'application/json',$headers,'test');

        dd($realmResponse);
    }

    private function cURLHttpClient($method, $url, $data = [], $contentType = 'application/json', $headers = [],$type=null)
   {
    $curl = curl_init();

    // Default headers
    // $defaultHeaders = [
    //     "Content-Type" => $contentType
    // ];

    // $headers = array_merge($defaultHeaders, $headers);

    if($type =='test')
    {
    //    dd($headers);
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    // Handle different request methods
    switch (strtoupper($method)) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
            // dd($contentType);
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