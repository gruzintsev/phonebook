<?php

Route::post('register', 'Api\UserController@register')->name('register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('contacts/{query}', 'ContactController@search')->name('contacts.search');
    Route::get('contacts/{page?}/{limit?}', 'ContactController@index')->name('contacts.index');
    Route::get('contact/{contact}', 'ContactController@show')->name('contacts.show');
    Route::post('contacts', 'ContactController@store')->name('contacts.store');
    Route::put('contacts/{contact}', 'ContactController@update')->name('contacts.update');
    Route::delete('contacts/{contact}', 'ContactController@delete')->name('contacts.delete');
});
