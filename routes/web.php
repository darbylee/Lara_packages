<?php

use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => ['auth:web'], 'namespace' => 'Pdusan\SimpleBlog\Http\Controllers'], function () {
Route::group(['middleware' => ['web'], 'namespace' => 'Pdusan\SimpleBlog\Http\Controllers'], function () {
    Route::group(['prefix' => 'sblog'], function () {
        Route::get('/', 'SBlogPostController@index')->name('sblog.post.index');
        Route::group(['prefix' => 'post'], function () {
            Route::get('/', 'SBlogPostController@index')->name('sblog.post.index');
            Route::get('create', 'SBlogPostController@create')->name('sblog.post.create');
            Route::post('store', 'SBlogPostController@store')->name('sblog.post.store');
            Route::get('edit/{id}', 'SBlogPostController@edit')->name('sblog.post.edit');
            Route::put('update/{id}', 'SBlogPostController@update')->name('sblog.post.update');
            Route::get('show/{id}', 'SBlogPostController@show')->name('sblog.post.show');
            Route::delete('delete/{id}', 'SBlogPostController@destroy')->name('sblog.post.destroy');
        });

        Route::group(['prefix' => 'comment'], function () {
            Route::post('store/{post_id}', 'SBlogCommentController@store')->name('sblog.comment.store');
            Route::delete('delete/{post_id}/{id}', 'SBlogCommentController@destroy')->name('sblog.comment.destroy');
        });

    });
});
