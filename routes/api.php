<?php 
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function(){
    Route::get('/test', function () {
        return 'SSO Test';
    });
});

?>