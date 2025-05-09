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
use App\Http\Controllers\webHookController;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;


// routes/web.php (or routes/api.php if you're using API)
Route::get('/dashboard/user-role-data', [TicketController::class, 'getUserRoleData'])->name('getUserRoleData');
Route::get('/dashboard/weekly-report', [TicketController::class, 'getDailySolvedTicketReport'])->name('getCompletedTicketsWeekly');
Route::get('/quickmate/dashboard/top-gorg',[TicketController::class, 'getTopOrganizationsByUserCount'])->name('getTopGorg');
Route::get('/dashboard/montly-tickets',[TicketController:: class, 'getMonthlyTicketsCount'])->name('getMonthlyTicketsCount');
Route::get('/quickmate/dashboard/listorg',[OrganizationController::class, 'getMonthlyOrganizationOnboardingData'])->name('orgpermonth');
Route::get('/dashboard/org-user-stats', [OrganizationController::class, 'getOrganizationsUserStats'])->name('getOrganizationsUserStatus');

Route::get('/quickmate/kloudstack/authenticate', [AuthenticationController::class, 'showSuccessPage'])
    ->middleware('role.auth')
    ->name('auth.success');


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/open-requests', [TicketController::class, 'getOpenRequests'])->name('getOpenRequests');

Route::get('/quickmate/kloudstack/authenticate/{token}', [AuthenticationController::class, 'authenticate'])
    ->name('quickmate.authenticate');

    Route::get('/authorize-user', [AuthenticationController::class, 'authorizeUser'])
    ->name('authorize.user');

    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');


Route::get('login', [UserController::class,'login'])->name('customer.loginform');
Route::post('login', [AuthController::class,'checkAuth'])->name('customer.login');
Route::get('user/register', [UserController::class,'register'])->name('customer.register');
Route::post('user/register', [UserController::class,'store'])->name('customer.store');
Route::post('/keycloak/webhook', [webHookController::class, 'handleWebhook']);

// Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::middleware('new.user')->prefix('user')->group(function () {
    // Route::get('dashboard', [UserController::class,'dashboard'])->name('customer.dashboard');
    // Route::post('logout', [UserController::class,'logout'])->name('customer.logout');
    Route::post('/logout/user', [AuthController::class, 'userLogout'])->name('logout.user')->withoutMiddleware('new.user');
    Route::post('create-ticket', [TicketController::class,'create'])->name('raise.ticket');
    Route::get('/get-subcategories', [CategoryController::class, 'getSubcategories'])->name('get.subcategories');
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
    Route::post('/update-ticket/{id}', [TicketController::class, 'updateTicket'])->name('update.ticket');
    Route::get('tickets/all-tickets', [TicketController::class,'allTicketsList'])->name('supportdesk.alltickets');
    Route::get('tickets/assigned-tickets', [TicketController::class,'assignedTicketsList'])->name('supporttickets.assignticket');
    Route::get('tickets/solved-tickets', [TicketController::class,'solvedTicketsList'])->name('supportdesk.solvedtickets');
    // test
    Route::post('assign-ticket', [TicketController::class,'assignTicket'])->name('supporttickets.assign');
    Route::get('ticket/{id}', [TicketController::class,'getTicketById'])->name('supportticket.get');
});

// admin routes

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/password/reset', [OrganizationController::class, 'showResetForm'])->name('password.reset.form')->withoutMiddleware('admin');
    Route::post('/password/reset', [OrganizationController::class, 'handlePasswordReset'])->name('password.reset.submit')->withoutMiddleware('admin');
    Route::get('login', [AuthController::class,'orgAdminLoginPage'])->name('admin.loginform')->withoutMiddleware('admin');
    Route::post('login', [AuthController::class,'orgAdminLogin'])->name('admin.login')->withoutMiddleware('admin');
    Route::post('/logout/admin', [AuthController::class, 'orgAdminLogout'])->name('logout.admin');
    Route::get('/user/view/{id}', [UserController::class, 'viewUser'])->name('view.user.model');
    Route::get('/batch-status/{id}', [UserController::class, 'checkBatchStatus'])->name('batch.status');
    Route::post('/user/create', [UserController::class, 'newuserstore'])->name('user.create');
    Route::get('dashboard', [AdminController::class,'index'])->name('admin.dashboard');
    Route::get('configurations', [AdminController::class,'configurations'])->name('admin.configurations');
    Route::get('tickets', [AdminController::class,'getTickets'])->name('admin.tickets');
    Route::get('reports',[AdminController::class, 'getReports'])->name('admin.reports');
    Route::get('tickets/list', [TicketController::class,'adminTicketsList'])->name('tickets.adminlist');
    Route::get('reports/list', [TicketController::class,'adminreportList'])->name('tickets.reprotslist');
    Route::get('categories', [CategoryController::class,'index'])->name('admin.categories');
    Route::post('/categories/update/{id}', [CategoryController::class, 'categoriesupdate'])->name('categories.update');
    Route::get('category/list',[CategoryController::class,'list'])->name('categories.list');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('category/add', [CategoryController::class,'store'])->name('add.category');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'categoriesedit'])->name('categories.edit');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'categoriesDelete'])->name('categories.delete');
    Route::get('ticket/view/{id}', [TicketController::class,'getTicketById'])->name('admin.ticket.view');
    Route::post('category/edit', [CategoryController::class,'update'])->name('edit.category');
    Route::post('category/delete',[CategoryController::class,'destroy'])->name('delete.category');
    Route::post('category/status', [CategoryController::class,'changeStatus'])->name('disable.category');
    Route::post('/assign-ticket', [TicketController::class, 'assignTicketadmin'])->name('assign.ticket-admin');
    Route::post('/reject-ticket', [TicketController::class, 'rejectTicket'])->name('reject.ticket');
    Route::get('assets', [AdminController::class,'assets'])->name('admin.assets');
    Route::get('siem', [AdminController::class,'addsiem'])->name('admin.siem');
    Route::get('manage/users', [AdminController::class,'manageuser'])->name('admin.manageuser');
    Route::get('/users-list', [UserController::class, 'ajaxList'])->name('users.index');
    Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('users.destroy');
    Route::post('/users/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');
    Route::get('/get-engineers',[TicketController::class,'getengineersreport'])->name('engineers.list.report');
    Route::get('/reports/export', [TicketController::class, 'export'])->name('tickets.reports.export');



        Route::get('/import-user', function () {
            return view('admin.newuser');
        })->name('import-user');
        Route::post('/import-excel', [UserController::class, 'import'])->name('import-excel');

        Route::get('/get-engineers/{ticketId}', [TicketController::class, 'getEngineers'])->name('get.engineers');
});

Route::middleware('superadmin')->prefix('quickmate')->group(function () {
    Route::get('login', [AuthController::class,'quickmateAdminLoginPage'])->name('quickmate.loginform')->withoutMiddleware('superadmin');
    Route::post('login', [AuthController::class,'quickmateAdminLogin'])->name('quickmate.login')->withoutMiddleware('superadmin');
    Route::post('/logout/quickmate', [AuthController::class, 'superAdminLogout'])->name('logout.superadmin');

    Route::get('dashboard', [superadminController::class,'index'])->name('super.admin.dashboard');
    Route::get('organization', [superadminController::class,'addorgnization'])->name('super.admin.org');
    Route::get('add/organization', [superadminController::class,'addneworgnization'])->name('super.admin.neworg');
    Route::post('/store-organization', [OrganizationController::class, 'store'])->name('organization.store');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations.index');
    Route::get('/organizations/data', [OrganizationController::class, 'getOrganizations'])->name('organizations.data');
    Route::get('/org/list', [OrganizationController::class, 'getLisenseOrganizations'])->name('org.list');
    Route::get('/organizations/lisense/{id}', [OrganizationController::class, 'lisenseshow'])->name('lisenseorganizations.show');
    Route::delete('/organizations/delete/{id}', [OrganizationController::class, 'destroy'])->name('organizations.delete');
    // Route::delete('/organizations/delete/{id}', [OrganizationController::class, 'destroy']);

    Route::get('/organizations/{id}', [OrganizationController::class, 'show'])->name('organizations.show');
    Route::post('/organizations/approve/{id}', [OrganizationController::class, 'approve'])->name('organizations.approve');
    Route::get('/companies/list', [superadminController::class,'lisense'])->name('companies.list');
    Route::get('/organizations/{id}/edit', [OrganizationController::class, 'edit'])->name('organizations.edit');
    Route::post('/organization/update/{id}', [OrganizationController::class, 'update'])->name('organization.update');
    Route::get('/organization/verifyorg', [OrganizationController::class, 'showOrganizations'])->name('organization.list');
    Route::post('/verifyorg/update', [OrganizationController::class, 'verify'])->name('superadmin.verifyorg.update');
    Route::post('/toggle-organization', [OrganizationController::class, 'toggleEnable'])->name('toggle.organization');
    Route::post('/toggle-role', [OrganizationController::class, 'toggleRoleEnable'])->name('toggle.roleEnable');
    Route::get('/organization/ldap', [OrganizationController::class, 'showLdap'])->name('organization.ldap');
    Route::post('/organization/ldap/update', [OrganizationController::class, 'updateLdap'])->name('superadmin.ldaporg.update');
});


Route::middleware('user.auth')->prefix('organization')->group(function () {

    Route::get('addorg', [OrganizationController::class,'addorg'])->name('new.org');
    // Route::post('/store-organization', [OrganizationController::class, 'store'])->name('organization.store');

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
// Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
// Route::get('/categories/edit/{id}', [CategoryController::class, 'categoriesedit'])->name('categories.edit');
// Route::post('/categories/update/{id}', [CategoryController::class, 'categoriesupdate'])->name('categories.update');
// Route::delete('/categories/delete/{id}', [CategoryController::class, 'categoriesDelete'])->name('categories.delete');

// Add this temporary route to inspect the filesystem config
Route::get('/debug-storage', function () {
    return [
        'storage_path' => storage_path('app/public'),
        'public_path' => public_path('storage'),
        'filesystem_config' => config('filesystems.disks.public'),
        'symlink_exists' => is_link(public_path('storage')),
        'env_app_url' => env('APP_URL'),
    ];
});

