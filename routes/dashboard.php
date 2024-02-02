<?php

 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\TaskController;
use App\Http\Controllers\Dashboard\StatisticsController;


Route::group([
    
    'prefix'=>'dashboard',
    'as'=>'dashboard.' ,
    'middleware'=>['auth:admin,web']

],function(){

     
    Route::resource('tasks', TaskController::class);

    Route::get('statistics',[StatisticsController::class,'index'])->name('statistics.index') ;


}) ;