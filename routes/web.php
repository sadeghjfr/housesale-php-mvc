<?php

use System\Router\Web\Route;

Route::get('', 'HomeController@index', 'index');
Route::get('create', 'HomeController@create', 'create');
Route::post('store', 'HomeController@store', 'store');
Route::get('edit/{id}', 'HomeController@edit', 'edit');
Route::put('update/{id}', 'HomeController@update', 'update');
Route::delete('delete/{id}', 'HomeController@destroy', 'delete');

// admin
Route::get('/admin', 'Admin\AdminController@index', 'admin.index');

// admin - category
Route::get('/admin/category', 'Admin\CategoryController@index', 'admin.category.index');
Route::get('/admin/category/create', 'Admin\CategoryController@create', 'admin.category.create');
Route::post('/admin/category/store', 'Admin\CategoryController@store', 'admin.category.store');
Route::get('/admin/category/edit/{id}', 'Admin\CategoryController@edit', 'admin.category.edit');
Route::put('/admin/category/update/{id}', 'Admin\CategoryController@update', 'admin.category.update');
Route::delete('/admin/category/delete/{id}', 'Admin\CategoryController@destroy', 'admin.category.delete');

// admin - post
Route::get('/admin/post', 'Admin\PostController@index', 'admin.post.index');
Route::get('/admin/post/create', 'Admin\PostController@create', 'admin.post.create');
Route::post('/admin/post/store', 'Admin\PostController@store', 'admin.post.store');
Route::get('/admin/post/edit/{id}', 'Admin\PostController@edit', 'admin.post.edit');
Route::put('/admin/post/update/{id}', 'Admin\PostController@update', 'admin.post.update');
Route::put('/admin/post/status/{id}', 'Admin\PostController@status', 'admin.post.status');
Route::delete('/admin/post/delete/{id}', 'Admin\PostController@destroy', 'admin.post.delete');

// admin - ads
Route::get('/admin/ads', 'Admin\AdsController@index', 'admin.ads.index');
Route::get('/admin/ads/create', 'Admin\AdsController@create', 'admin.ads.create');
Route::post('/admin/ads/store', 'Admin\AdsController@store', 'admin.ads.store');
Route::get('/admin/ads/edit/{id}', 'Admin\AdsController@edit', 'admin.ads.edit');
Route::put('/admin/ads/update/{id}', 'Admin\AdsController@update', 'admin.ads.update');
Route::delete('/admin/ads/delete/{id}', 'Admin\AdsController@destroy', 'admin.ads.delete');

Route::get('/admin/ads/gallery/{id}', 'Admin\AdsController@gallery', 'admin.ads.gallery');
Route::post('/admin/ads/store-gallery-image/{id}', 'Admin\AdsController@storeGalleryImage', 'admin.ads.store.gallery.image');
Route::get('/admin/ads/delete-gallery-image/{gallery_id}', 'Admin\AdsController@deleteGalleryImage', 'admin.ads.delete.gallery.image');
