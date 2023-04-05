<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if(Auth::check()){		
		return redirect()->route('home');
	}else{
		return view('auth.login');
	}
});    


Auth::routes();

Route::middleware(['auth'])->group(function () {

	Route::get('home', 'HomeController@index')->name('home');

	Route::get('projects/makedocument', 'ProjectController@makeDocument')->name('projects.makedocument');

	Route::resource('projects', 'ProjectController');

	Route::resource('tasks', 'TaskController');

	Route::get('tasks/create/{task}', 'TaskController@create')->name('tasks.create');

	Route::get('tasks/{task}/editFunctionPoint', 'TaskController@editFunctionPoint')->name('tasks.editFunctionPoint');

	Route::put('tasks/fp/{task}', 'TaskController@updateFunctionPoint')->name('tasks.updateFunctionPoint');

	Route::post('export', 'PdfviewController@index')->name('export');

});

