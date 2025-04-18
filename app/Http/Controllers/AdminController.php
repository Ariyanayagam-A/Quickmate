<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard')->with('activeLink','dashboard');
    }

    public function assets(){
        // return view('superadmin.assets');
        session()->flash('success', 'User added successfully!');

        return view('admin.assets');
    }

    public function addsiem(){
        session()->flash('success', 'User added successfully!');

        return view('admin.siem');
    }

    public function manageuser(){
        // dd(Session::all());
        $roles = Role::select('id','name')->where('org_id',Session::get('organization')->id)->get()->toArray();

        // dd($roles);
        // session()->flash('success', 'User added successfully!');

        return view('admin.manageuser',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getTickets()
    {
        
        return view('admin.tickets')->with('activeLink','tickets');
    }

    public function getReports(){

        return view('admin.report')->with('activeLink','tickets');
    }

    public function configurations()
    {
        return view('admin.configurations')->with('activeLink','tickets');
    }
    
}

