<?php

Route::group([
    'middleware' => 'auth:api',
], function () {

    Route::get('contacts', 'ContactsController@index');
    Route::post('contacts', 'ContactsController@store');
    Route::get('contacts/{contact}', 'ContactsController@show')->name('contacts.show');
    Route::put('contacts/{contact}', 'ContactsController@update');
    Route::delete('contacts/{contact}', 'ContactsController@destroy');

});
