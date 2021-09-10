<?php

use Illuminate\Support\Facades\Route;


/**
 * 主页 帮助页 关于页
 */
Route::get('/','StaticPagesController@home')
->name('home');
Route::get('/help','StaticPagesController@help')
->name('help');
Route::get('/about','StaticPagesController@about')
->name('about');

/**
 * 注册页面
*/
Route::get('/signup','UserController@create')
->name('signup');

/**
 * 用户资源路由
*/
Route::resource('users','UserController');


/**
 * 显示用户信息
 */
Route::get('/user/{user}','UserController@show')
->name('user.show');

/**
 * 接受用户提交的表单信息
 */
//Route::get('/u','UserController@store')
//    ->name('user.store');
