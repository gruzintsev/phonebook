<?php

Route::group(['prefix' => 'hostaway'], function() {
    Route::get('countries', 'HostawayController@countries')->name('hostaway_countries');
    Route::get('timezones', 'HostawayController@timezones')->name('hostaway_timezones');
});