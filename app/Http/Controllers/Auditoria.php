<?php

namespace RELSIAFI\Http\Controllers;

use Illuminate\Http\Request;
use RELSIAFI\Http\Requests;
use RELSIAFI\Http\Controllers\Controller;

class Auditoria extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auditoria/index');
    }
}
