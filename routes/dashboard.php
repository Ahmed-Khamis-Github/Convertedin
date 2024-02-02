<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;


Route::group([
    
    'prefix'=>'dashboard',
    'as'=>'dashboard.' ,
    'middleware'=>['auth:admin,web']

],function(){

     


}) ;