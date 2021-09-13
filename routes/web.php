<?php

use Illuminate\Support\Facades\Route;


/**
 * 主页 帮助页 关于页
 */
Route::get('/', 'StaticPagesController@home')
    ->name('home');
Route::get('/help', 'StaticPagesController@help')
    ->name('help');
Route::get('/about', 'StaticPagesController@about')
    ->name('about');

/**
 * 注册页面
 */
Route::get('/signup', 'UserController@create')
    ->name('signup');

/**
 * 用户资源路由
 */
Route::resource('users', 'UserController');


/**
 * 会话 创建 登录 注销
 */

Route::get('/login', 'SessionController@create')
    ->name('login');
Route::post('/store', 'SessionController@store')
    ->name('store');
Route::delete('/logout', 'SessionController@destroy')
    ->name('logout');

