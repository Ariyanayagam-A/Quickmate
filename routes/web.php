<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\TicketController;     
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AzureAuthController;
use App\Http\Controllers\Auth\LdapController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return redirect('user/login');
});

// user routes 

Route::get('user/login', [UserController::class,'login'])->name('customer.loginform');
Route::post('user/login', [AuthController::class,'checkAuth'])->name('customer.login');
Route::get('user/register', [UserController::class,'register'])->name('customer.register');
Route::post('user/register', [UserController::class,'store'])->name('customer.store');

Route::middleware('user.auth')->prefix('user')->group(function () {
    Route::get('dashboard', [UserController::class,'dashboard'])->name('customer.dashboard');
    Route::post('logout', [UserController::class,'logout'])->name('customer.logout');
    Route::post('create-ticket', [TicketController::class,'create'])->name('raise.ticket');
    Route::get('raise-ticket', [TicketController::class,'raiseTicket'])->name('ticketform');
    Route::get('tickets', [TicketController::class,'index'])->name('customer.tickets');
    Route::get('tickets/list', [TicketController::class,'list'])->name('tickets.list');
    Route::get('edit/ticket/{id}',[TicketController::class,'edit'])->name('edit.ticket');
    Route::post('update/ticket/{id}',[TicketController::class,'update'])->name('update.ticket');
    Route::post('delete/ticket/{id}',[TicketController::class,'destroy'])->name('delete.ticket');
});

// support desk routes

Route::middleware('user.auth')->prefix('supportdesk')->group(function () {
    Route::get('tickets', [TicketController::class,'ticketsView'])->name('supporttickets.view');
    Route::get('tickets/list', [TicketController::class,'supportTicketlist'])->name('supporttickets.list');
    Route::post('assign-ticket', [TicketController::class,'assignTicket'])->name('supporttickets.assign');
    Route::get('ticket/{id}', [TicketController::class,'getTicketById'])->name('supportticket.get'); 
});

// admin routes

Route::middleware('user.auth')->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class,'index'])->name('admin.dashboard');
    Route::get('configurations', [AdminController::class,'configurations'])->name('admin.configurations');
    Route::get('tickets', [AdminController::class,'getTickets'])->name('admin.tickets');
    Route::get('tickets/list', [TicketController::class,'adminTicketsList'])->name('tickets.adminlist');
    Route::get('categories', [CategoryController::class,'index'])->name('admin.categories');
    Route::get('category/list',[CategoryController::class,'list'])->name('categories.list');
    Route::post('category/add', [CategoryController::class,'store'])->name('add.category');
    Route::post('category/edit', [CategoryController::class,'update'])->name('edit.category');
    Route::post('category/delete',[CategoryController::class,'destroy'])->name('delete.category');
    Route::post('category/status', [CategoryController::class,'changeStatus'])->name('disable.category');
});


Route::middleware('user.auth')->prefix('agent')->group(function () {
    Route::get('tickets', [TicketController::class,'getagentTickets'])->name('agenttickets.view');
    Route::get('tickets/list', [TicketController::class,'agentTicketlist'])->name('agenttickets.list');
    Route::get('ticket/view/{id}', [TicketController::class,'getTicketById'])->name('ticket.view');
    Route::post('ticket/solve', [TicketController::class,'resolveTicket'])->name('solveticket');
});

// Azure AD Authentication routes

Route::get('/auth/azure', [AzureAuthController::class, 'redirectToAzure'])->name('azure.login');
Route::get('/auth/azure/callback', [AzureAuthController::class, 'handleAzureCallback']);

// LDAP routes

Route::get('/ldap/users', [LdapController::class, 'getUsers']);


//Categories Store Route
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}', [CategoryController::class, 'categoriesedit'])->name('categories.edit');
Route::post('/categories/update/{id}', [CategoryController::class, 'categoriesupdate'])->name('categories.update');
Route::delete('/categories/delete/{id}', [CategoryController::class, 'categoriesDelete'])->name('categories.delete');

