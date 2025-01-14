<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\TicketController;     

Route::get('/', function () {
    return redirect('user/login');
});

// user routes 

Route::get('user/login', [UserController::class,'login'])->name('customer.loginform');
Route::post('user/login', [UserController::class,'verifylogin'])->name('customer.login');
Route::get('user/register', [UserController::class,'register'])->name('customer.register');
Route::post('user/register', [UserController::class,'store'])->name('customer.store');

Route::middleware('user.auth')->prefix('user')->group(function () {
    Route::get('dashboard', [UserController::class,'index'])->name('customer.dashboard');
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


Route::middleware('user.auth')->prefix('agent')->group(function () {
    Route::get('tickets', [TicketController::class,'getagentTickets'])->name('agenttickets.view');
    Route::get('tickets/list', [TicketController::class,'agentTicketlist'])->name('agenttickets.list');
    Route::get('ticket/view/{id}', [TicketController::class,'getTicketById'])->name('ticket.view');
    Route::post('ticket/solve', [TicketController::class,'resolveTicket'])->name('solveticket');
});