<?php
namespace App\Services;

use LdapRecord\Container;
use LdapRecord\Connection;

class LdapService
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new Connection([
            'hosts' => [env('LDAP_HOSTS',"20.168.243.12")],
            'port' => env('LDAP_PORT', default: "389"),
            'base_dn' => env('LDAP_BASE_DN',"DC=demodc,DC=local"),
            'username' => env('LDAP_USERNAME',"dcadmin@demodc.local"),
            'password' => env('LDAP_PASSWORD',"Password@2024"),
            'use_ssl' => false,
            'use_tls' => false,
        ]);

        try {
            $this->connection->connect();
        } catch (\Exception $e) {
            throw new \Exception('Could not connect to LDAP server: ' . $e->getMessage());
        }
    }

    public function searchUsers($searchUser)
    {
        $query = $this->connection->query()
            ->where('objectClass', '=', 'user')
            ->where('objectCategory', '=', 'person')
            ->where('sAMAccountName', '=', $searchUser);

        $users = $query->get();

        return $this->convertToUtf8($users);
    }

    private function convertToUtf8($data)
    {
        return json_decode(json_encode($data, JSON_INVALID_UTF8_IGNORE), true);
    }

}


?>