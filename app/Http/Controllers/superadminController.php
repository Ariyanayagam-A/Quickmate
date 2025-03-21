<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class superadminController extends Controller
{
    public function index()
    {
        return view('superadmin.dashboard')->with('activeLink','dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function addorgnization(){
       
        return view('superadmin.organization');    
    }

    public function addneworgnization(){
       
        return view('organization.addorg');    
    }

    public function addsiem(){
        session()->flash('success', 'User added successfully!');

        return view('superadmin.assets');
    }

    public function assets(){
        // return view('superadmin.assets');
        session()->flash('success', 'User added successfully!');

        return view('superadmin.assets');
    }

    public function lisense(){
        // return view('superadmin.assets');
       
        return view('superadmin.lisense');
    }
}
