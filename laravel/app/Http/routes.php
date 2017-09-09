<?php

Route::get('/', 'HomeController@index');

Route::post('/create', 'LinkController@create');

