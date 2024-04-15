<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {


    Route::get('events', 'EventController@index');
    Route::get('events/{event}', 'EventController@show');
    // Route::get('events/{id}/subscriptions', 'EventController@subscriptions');

    Route::get('subscriptions', 'SubscriptionController@index');
    Route::get('subscriptions/{subscription}', 'SubscriptionController@show');
    // Route::post('subscriptions/register', 'SubscriptionController@store');
    // Route::post('subscriptions/{id}/cancel', 'SubscriptionController@destroy');
    // Route::post('subscriptions/{id}/checkin', 'SubscriptionController@checkin');

    // Route::get('users', 'UsersController@index');
    // Route::get('users/{id}', 'UsersController@show');
    // Route::post('users/register', 'UsersController@store');

    // Route::post('auth/login', 'AuthController@login');
    // Route::post('auth/logout', 'AuthController@logout');

    // Route::post('email/send/subscriptions/user/{id}', 'EmailController@sendSubscriptions');

});


// eventsfull/api/v1/events ->Return all events
// eventsfull/api/v1/events/{id} ->Return event with id = {id}
// eventsfull/api/v1/events/{id}/subscriptions ->Return all subscriptions for event with id = {id}

// eventsfull/api/v1/subscriptions ->Return all subscriptions
// eventsfull/api/v1/subscriptions/{id} ->Return subscription with id = {id}
// eventsfull/api/v1/subscriptions/register ->Register a new subscription for an event
// eventsfull/api/v1/subscriptions/{id}/cancel ->Cancel subscription with id = {id}
// eventsfull/api/v1/subscriptions/{id}/checkin ->Check-in subscription with id = {id}

// eventsfull/api/v1/users ->Return all users
// eventsfull/api/v1/users/{id} ->Return user with id = {id}
// eventsfull/api/v1/users/register ->Register a new user

// eventsfull/api/v1/auth/login ->Login
// eventsfull/api/v1/auth/logout ->Logout

// eventsfull/api/v1/email/send/subscriptions/user/{id} ->Send email to user with all subscriptions for user with id = {id}







?>
