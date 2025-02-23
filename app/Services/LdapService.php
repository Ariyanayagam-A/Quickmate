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
            'hosts' => [env('LDAP_HOSTS')],
            'port' => env('LDAP_PORT', 389),
            'base_dn' => env('LDAP_BASE_DN'),
            'username' => env('LDAP_USERNAME'),
            'password' => env('LDAP_PASSWORD'),
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