<?php

namespace RELSIAFI\Http\Controllers;

use Illuminate\Http\Request;

use RELSIAFI\Http\Requests;
use RELSIAFI\Http\Controllers\Controller;
use RELSIAFI\Model\LDAP\User as LDAPUser;

class Application extends Controller
{

    public function index()
    {
        return view('layout/base');
    }

}
