<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterAuthController extends Controller
{
    public function __construct(LdapController $ldapController)
    {
        $this->ldapController = $ldapController;
    }

    public function createRealmTest()
    {
        
    }

}
