<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function (){
    Route::match(['get', 'post'], '/', ['uses' => 'IndexController@execute', 'as' => 'home']);
    Route::get('/page/{alias}', ['uses' => 'PageController@execute', 'as' => 'page']);
    Route::auth();
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function (){
    //admin
    Route::get('/', function (){

    });
    //admin/pages
    Route::group(['prefix' => 'pages'], function (){

        //admin/pages
        Route::get('/', ['uses' => 'PagesController@execute', 'as' => 'pages']);

        //admin/pages/add
        Route::match(['get', 'post'], '/add', ['uses' => 'PagesAddController@execute', 'as' => 'pagesAdd']);

        //admin/edit/2
        Route::match(['get', 'post', 'delete'], '/edit{page}', ['uses' => 'PagesEditController@execute', 'as' => 'pagesEdit']);
    });

    Route::group(['prefix' => 'portfolio'], function (){

        //admin/pages
        Route::get('/', ['uses' => 'PortfolioController@execute', 'as' => 'portfolio']);

        //admin/pages/add
        Route::match(['get', 'post'], '/add', ['uses' => 'PortfolioAddController@execute', 'as' => 'portfolioAdd']);

        //admin/edit/2
        Route::match(['get', 'post', 'delete'], '/edit{portfolio}', ['uses' => 'PortfolioEditController@execute', 'as' => 'portfolioEdit']);
    });

    Route::group(['prefix' => 'services'], function (){

        //admin/pages
        Route::get('/', ['uses' => 'ServiceController@execute', 'as' => 'services']);

        //admin/pages/add
        Route::match(['get', 'post'], '/add', ['uses' => 'ServiceAddController@execute', 'as' => 'serviceAdd']);

        //admin/edit/2
        Route::match(['get', 'post', 'delete'], '/edit{service}', ['uses' => 'ServiceEditController@execute', 'as' => 'serviceEdit']);
    });
});
