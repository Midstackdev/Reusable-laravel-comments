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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('comments', 'Comments\CommentController');
Route::resource('comments/{comment}/replies', 'Comments\CommentReplyController');

Route::resource('courses', 'CourseController');

Route::resource('courses/{course}/comments', 'Courses\CourseCommentController', [
	'names' => [
		'index' => 'course.comment.index'
	]
]);
