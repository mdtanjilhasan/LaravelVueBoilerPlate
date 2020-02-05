<?php
Route::middleware(['throttle:60,1'])->group(function (){

Route::get('/', 'FrontEndController@getPublicHome')->name('public-home');

Auth::routes();

    Route::middleware(['auth'])->group(function (){
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::GET('/users',['middleware' => ['permission:read-users'], 'uses' => 'UserController@index'])->name('users.index');
        Route::GET('/users/data',['middleware' => ['permission:read-users'], 'uses' => 'UserController@getUsers'])->name('users.data');
        Route::GET('/user/{id}',['middleware' => ['permission:read-users'], 'uses' => 'UserController@edit'])->name('userEdit');
        Route::POST('/users-store','UserController@store')->name('users.store');
        Route::GET('/user-roles',['middleware' => ['permission:create-users'], 'uses' => 'UserController@allRoles'])->name('user.roles');
        Route::DELETE('/delete-user/{user}','UserController@deleteUser')->name('user.delete');
        Route::POST('/update-user/{id}','UserController@update')->name('users.update');
    });
});
