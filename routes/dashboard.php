<?php

 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\TaskController;


Route::group([
    
    'prefix'=>'dashboard',
    'as'=>'dashboard.' ,
    'middleware'=>['auth:admin,web']

],function(){

     
    Route::resource('tasks', TaskController::class);


}) ;