<?php

Route::get('/', 'HomeController@index');

Route::post('/create', 'LinkController@create');

Route::get('/{hash}', 'LinkController@get');

