<?php
namespace App\Services;

use App\Models\Organization;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class MasterAuthService
{
    protected $connection;

    public function __construct()
    {

    }

    public function loginService($userData,$type)
    {
        $userData['email'] = isset($userData['email']) ? $userData['email'] : $userData['name_email'];

        $domain = explode("@", $userData['email'] )[1];
        $company = explode(".", $domain)[0];

        $Organization = Organization::where('domain_name','like',$company)->first();
        $userResData = User::where('email',$userData['email'])->first();
        Session::put('organization',$Organization);
        Session::put('userdata',$userResData);

        $payload  = [
            'realm' => $Organization->realm,
            'username' => $userData['email'],
            'password' => $userData['password'],
            'type'     =>  $type
        ];

        $secretKey = $Organization->secret;
        // dd($secretKey);
        $endpoint = 'https://sso.kloudstacks.com/api/v1/auth/login';

        $headers = [
            'authkey:'.$secretKey,
            'Content-Type: application/json'
        ];

        $getAccessObject =  $this->cURLHttpClient('POST',$endpoint,$payload,'application/json',$headers);

        if($getAccessObject['status_code'] == '200' || isset($getAccessObject['response']['access_token']))
        {
           return $getAccessObject['response']['access_token'];
        }
    }

    public function loginServiceUser($userData,$type)
    {
        // $type = $action;
        $userData['email'] = isset($userData['email']) ? $userData['email'] : $userData['name_email'];

        $userResData = User::where('email',$userData['email'])->first();
        //  dd($userResData);
        $Organization = Organization::where('id',$userResData->organization_id)->first();
        // dd($userResData);
        Session::put('organization',$Organization);
        Session::put('userdata',$userResData);

        $payload  = [
            'realm' => $Organization->realm,
            'username' => $userData['email'],
            'password' => $userData['password'],
            'type'     =>  $type
        ];

        $secretKey = $Organization->secret;

        // dd($secretKey);

        $endpoint = 'https://sso.kloudstacks.com/api/v1/auth/login';

        $headers = [
            'authkey:'.$secretKey,
            'Content-Type: application/json'
        ];

        $getAccessObject =  $this->cURLHttpClient('POST',$endpoint,$payload,'application/json',$headers);

        // dd($getAccessObject);

        if($getAccessObject['status_code'] == '200' || isset($getAccessObject['response']['access_token']))
        {
           return $getAccessObject['response']['access_token'];
        }
    }

    public function createOrgRealm($realmData)
    {
        $endpoint = 'https://sso.kloudstacks.com/api/v1/auth/create';
        $payload  = [
            'username' => $realmData
        ];
        $headers = [
              'Content-Type: application/json'
        ];

        $realmResponse =  $this->cURLHttpClient('POST',$endpoint,$payload,'application/json',$headers,'test');

        return $realmResponse;
    }

    public function createUser($userData)
    {
        $org = Organization::find($userData->organization_id);

       $endpoint = "https://sso.kloudstacks.com/api/v1/auth/user/create";

       $payload = [
            "username" => $userData->name,
            "firstname" => $userData->fname,
            "lastname" => $userData->lname,
            "email" => $userData->email,
            "password" => $userData->org_password,
            "account" => $org->realm
        ];

        $headers = [ 'Content-Type: application/json'];

        $realmResponse =  $this->cURLHttpClient('POST',$endpoint,$payload,'application/json',$headers);

        // dd($realmResponse);

        if($realmResponse['status_code'] == '200' || isset($getAccessObject['response']['status']))
        {
           return true;
        }

          return false;
    }

    public function sendLdapDetails($ldapData)
    {
        $endpoint = "http://localhost:3000/api/v1//ldapConnection";

        $payload = [
            "ldap_id" => $ldapData['ldap_id'],
            "ldap_password" => $ldapData['ldap_password'],
            "domain_name" => $ldapData['domain_name'],
            "connection_url" => $ldapData['connection_url']
        ];

        $headers = ['Content-Type: application/json'];

        $response = $this->cURLHttpClient('POST', $endpoint, $payload, 'application/json', $headers);

        // Don't just return true/false, return the full response
        return $response;
    }


    private function cURLHttpClient($method, $url, $data = [], $contentType, $headers = [],$type=null)
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
            // dd(json_encode($data));
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case "GET":
            if (!empty($data)) {
                //$url .= '?' . http_build_query($data);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

            }
            break;
        case "PUT":
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_POSTFIELDS, ($contentType === 'application/json') ? json_encode($data) : http_build_query($data));
            break;
    }

    $response = curl_exec($curl);
    // dd($curl,$response);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // Handle errors
    if ($response === false) {
        return ['error' => curl_error($curl)];
    }

    curl_close($curl);

    return ['status_code' => $httpCode, 'response' => json_decode($response, true) ?? $response];
  }

  public function clientSecretService($realm)
  {
    $endpoint = "https://sso.kloudstacks.com/api/v1/auth/clientid/enable/$realm";

    $clientSecretEnableResponse =  $this->cURLHttpClient('GET',$endpoint,[],'application/json',[]);

    // dd($clientSecretEnableResponse);
    if($clientSecretEnableResponse['status_code'] == '200' && isset($clientSecretEnableResponse['response']['status']))
    {
       return $clientSecretEnableResponse['response'];
    }
  }

  public function getRoleByUserId()
  {
    $endpoint = "https://sso.kloudstacks.com/api/v1/auth/clientid/enable/$realm";

    $clientSecretEnableResponse =  $this->cURLHttpClient('GET',$endpoint,[],'application/json',[]);

    // dd($clientSecretEnableResponse);
    if($clientSecretEnableResponse['status_code'] == '200' && isset($clientSecretEnableResponse['response']['status']))
    {
       return $clientSecretEnableResponse['response'];
    }

  }


  public function createRoleService($realmData)
  {
    $endpoint = "https://sso.kloudstacks.com/api/v1/roles/create";

    $payload = [
        'username' => $realmData
    ];

    $headers = [ 'Content-Type: application/json'];

    $clientRoleEnableResponse =  $this->cURLHttpClient('POST',$endpoint,$payload,'application/json',$headers);

    if($clientRoleEnableResponse['status_code'] == '200' && isset($clientRoleEnableResponse['response']['status']))
    {
       return $clientRoleEnableResponse['response']['data'];
    }
    else{
        return false;
    }
  }

  public function getUserIdandUpdate($realmData)
  {
    $endpoint = "https://sso.kloudstacks.com/api/v1/auth/user/Arya/sabari";

    $payload = [
        'username' => $realmData
    ];

    $headers = [ 'Content-Type: application/json'];

    $clientRoleEnableResponse =  $this->cURLHttpClient('POST',$endpoint,$payload,'application/json',$headers);

    if($clientRoleEnableResponse['status_code'] == '200' && isset($clientRoleEnableResponse['response']['status']))
    {
       return $clientRoleEnableResponse['response']['data'];
    }
    else{
        return false;
    }
  }

}


?>
