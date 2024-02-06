<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Models\User;

//show all listing
Route::get('/',([ListingController::class,'index']));


//create listing form
Route::get('/listings/create',([ListingController::class,'create']))
       ->middleware('auth');

//validate listing
Route::post('/listings',([ListingController::class,'store']));

//show edit form
Route::get('/listings/{listing}/edit',([ListingController::class,'edit']));

//edit submit to update
Route::put('/listings/{listing}',([ListingController::class,'update']));

//delete listing
Route::delete('/listings/{listing}',([ListingController::class,'destroy']));


//manage listing
Route::get('/listings/manage',([ListingController::class,'manage']))
       ->middleware('auth');


//show single listing
Route::get('/listings/{listing}',([ListingController::class,'show']));

//show register create form
Route::get('/register',([UserController::class,'create']))
       ->middleware('guest');

//validate new user
Route::post('/users',([UserController::class,'store']));

//logout user
Route::post('/logout',([UserController::class,'logout']))
       ->middleware('auth');

//show login form
Route::get('/login',([UserController::class,'login']))
       ->name('login');

//login user
Route::post('/users/authenticate',([UserController::class,'authenticate']));

