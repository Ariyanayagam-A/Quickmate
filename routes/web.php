<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\TicketController;     
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AzureAuthController;
use App\Http\Controllers\Auth\LdapController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\superadminController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return redirect('user/login');
});

// user routes 


Route::get('/quickmate/kloudstack/authenticate/{token}', [AuthenticationController::class, 'authenticate'])
    ->name('quickmate.authenticate');

    Route::get('/authorize-user', [AuthenticationController::class, 'authorizeUser'])
    ->name('authorize.user');
    
    Route::get('/redirect', function () {
        // This will trigger the middleware
    })->middleware('role.redirect')->name('role.redirect');
    
    

Route::get('user/login', [UserController::class,'login'])->name('customer.loginform');
Route::post('user/login', [AuthController::class,'checkAuth'])->name('customer.login');
Route::get('user/register', [UserController::class,'register'])->name('customer.register');
Route::post('user/register', [UserController::class,'store'])->name('customer.store');

Route::post('/update-ticket/{id}', [TicketController::class, 'updateTicket'])->name('update.ticket');


Route::middleware('new.user')->prefix('user')->group(function () {
    // Route::get('dashboard', [UserController::class,'dashboard'])->name('customer.dashboard');
    Route::post('logout', [UserController::class,'logout'])->name('customer.logout');
    Route::post('create-ticket', [TicketController::class,'create'])->name('raise.ticket');
    Route::get('dashboard', [TicketController::class,'raiseTicket'])->name('ticketform');
    Route::get('tickets', [TicketController::class,'index'])->name('customer.tickets');
    Route::get('tickets/list', [TicketController::class,'list'])->name('tickets.list');
    Route::get('edit/ticket/{id}',[TicketController::class,'edit'])->name('edit.ticket');
    Route::post('update/ticket/{id}',[TicketController::class,'update'])->name('update.ticket');
    Route::post('delete/ticket/{id}',[TicketController::class,'destroy'])->name('delete.ticket');
});

// support desk routes

Route::middleware('support')->prefix('supportdesk')->group(function () {
    Route::get('tickets', [TicketController::class,'ticketsView'])->name('supporttickets.view');
    Route::get('ticket-status', [TicketController::class,'ticketsStatusView'])->name('supportticketsstatus.view');
    Route::get('ticket-history', [TicketController::class,'ticketsHistoryView'])->name('supportticketshistory.view');
    Route::get('tickets/list', [TicketController::class,'supportTicketlist'])->name('supporttickets.list');
    Route::get('tickets/all-tickets', [TicketController::class,'allTicketsList'])->name('supportdesk.alltickets');
    Route::get('tickets/assigned-tickets', [TicketController::class,'assignedTicketsList'])->name('supporttickets.assignticket');
    Route::get('tickets/solved-tickets', [TicketController::class,'solvedTicketsList'])->name('supportdesk.solvedtickets');
    // test
    Route::post('assign-ticket', [TicketController::class,'assignTicket'])->name('supporttickets.assign');
    Route::get('ticket/{id}', [TicketController::class,'getTicketById'])->name('supportticket.get'); 
});

// admin routes

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class,'index'])->name('admin.dashboard');
    Route::get('configurations', [AdminController::class,'configurations'])->name('admin.configurations');
    Route::get('tickets', [AdminController::class,'getTickets'])->name('admin.tickets');
    Route::get('tickets/list', [TicketController::class,'adminTicketsList'])->name('tickets.adminlist');
    Route::get('categories', [CategoryController::class,'index'])->name('admin.categories');
    Route::get('category/list',[CategoryController::class,'list'])->name('categories.list');
    Route::post('category/add', [CategoryController::class,'store'])->name('add.category');
    Route::get('ticket/view/{id}', [TicketController::class,'getTicketById'])->name('ticket.view');
    Route::post('category/edit', [CategoryController::class,'update'])->name('edit.category');
    Route::post('category/delete',[CategoryController::class,'destroy'])->name('delete.category');
    Route::post('category/status', [CategoryController::class,'changeStatus'])->name('disable.category');
    Route::post('/assign-ticket', [TicketController::class, 'assignTicketadmin'])->name('assign.ticket-admin');
    Route::post('/reject-ticket', [TicketController::class, 'rejectTicket'])->name('reject.ticket');
    Route::get('assets', [AdminController::class,'assets'])->name('admin.assets');
    Route::get('siem', [AdminController::class,'addsiem'])->name('admin.siem');
    Route::get('manage/users', [AdminController::class,'manageuser'])->name('admin.manageuser');





});

Route::middleware('superadmin')->prefix('quickmate/admin')->group(function () {
    Route::get('dashboard', [superadminController::class,'index'])->name('super.admin.dashboard');
    Route::get('organization', [superadminController::class,'addorgnization'])->name('super.admin.org');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations.index');
    Route::get('/organizations/data', [OrganizationController::class, 'getOrganizations'])->name('organizations.data');
    Route::get('/lisense/organizations/data', [OrganizationController::class, 'getLisenseOrganizations'])->name('lisense.organizations.data');
    Route::get('/organizations/lisense/{id}', [OrganizationController::class, 'lisenseshow'])->name('organizations.show');
    Route::delete('/organizations/delete/{id}', [OrganizationController::class, 'destroy']);


    

    Route::get('/organizations/{id}', [OrganizationController::class, 'show'])->name('organizations.show');
    Route::post('/organizations/approve/{id}', [OrganizationController::class, 'approve'])->name('organizations.approve');
    Route::get('siem', [superadminController::class,'addsiem'])->name('super.admin.siem');
    Route::get('assets', [superadminController::class,'assets'])->name('super.admin.assets');
    Route::get('lisense', [superadminController::class,'lisense'])->name('super.admin.lisense');

});


Route::middleware('user.auth')->prefix('organization')->group(function () {

    Route::get('addorg', [OrganizationController::class,'addorg'])->name('new.org');
    Route::post('/store-organization', [OrganizationController::class, 'store'])->name('organization.store');

});


Route::middleware('agent')->prefix('agent')->group(function () {
    Route::get('tickets', [TicketController::class,'getagentTickets'])->name('agenttickets.view');
    Route::get('tickets/hold', [TicketController::class,'getagentholdesTickets'])->name('agentholdedtickets.view');
    Route::get('tickets/history', [TicketController::class,'getagenthistoryesTickets'])->name('agenthistoryestickets.view');
    Route::get('tickets/holded', [TicketController::class,'getagentHoldTickets'])->name('agentholdtickets.list');
    Route::get('tickets/historyes', [TicketController::class,'getagenthistoryTickets'])->name('agenthistorytickets.list');
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

Route::get('/dummy', function () {
    return view('pages.dummy');
})->name('dummy');