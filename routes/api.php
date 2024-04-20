<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {


    Route::get('events', 'EventController@index');
    Route::get('events/{event}', 'EventController@show');


    Route::get('subscriptions', 'SubscriptionController@index');
    Route::get('subscriptions/{subscription}', 'SubscriptionController@show');

    Route::post('subscriptions/register', 'SubscriptionController@store');

    Route::post('subscriptions/{subscription}/checkin', 'SubscriptionController@checkin');
    Route::post('subscriptions/{subscription}/cancel', 'SubscriptionController@cancel');

    Route::get( 'subscription/{user}/email', 'SubscriptionController@sendSubscriptions'  );

    Route::get('users', 'UsersController@index');
    Route::get('users/{user}', 'UsersController@show');
    Route::post('users/register', 'UsersController@store');

    Route::post('auth/', 'AuthController@auth');

});
?>
