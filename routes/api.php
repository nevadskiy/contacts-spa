<?php

Route::group([
    'middleware' => 'auth:api',
], function () {

    Route::post('contacts', 'ContactsController@store');
    Route::get('contacts/{contact}', 'ContactsController@show');
    Route::put('contacts/{contact}', 'ContactsController@update');
    Route::delete('contacts/{contact}', 'ContactsController@destroy');

});
