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

Route::get('/', 'Postcontroller@index');
Route::post('/addItem', 'Postcontroller@addItem');
Route::post('editItem', 'Postcontroller@editItem');
Route::post('deleteItem', 'Postcontroller@deleteItem');

Route::get('/', 'Postcontroller@index');
Route::get('/postIterm', 'Postcontroller@postIterm'); 
Route::get('/getPost', 'Postcontroller@getPost'); 
Route::get('/about', 'Postcontroller@about'); 
Route::delete('/post/{id}', 'Postcontroller@destroy');
Route::post('/post', 'Postcontroller@store');
Route::get('/post/edit/{id}','Postcontroller@edit');

Route::get('crop-image', 'ImageController@index');
Route::post('crop-image', ['as'=>'upload.image','uses'=>'ImageController@uploadImage']);
// upload multiple
Route::get('images-upload', 'AjaxUploadMultiimg@imagesUpload');
Route::post('images-upload', 'AjaxUploadMultiimg@imagesUploadPost')->name('images.upload');
// upload and show in fron-end
Route::get('image-view','DropzoneController@index');
Route::post('image-view','DropzoneController@store');

// Image managment 

Route::resource('posts' , 'Postcontroller');
Route::resource('pages' , 'Postcontroller');

// Route::get('/about', function () {
//     return view('pages.about');
// });
// upload image
Route::get('ajaxImageUpload', ['uses'=>'AjaxImageUploadController@ajaxImageUpload']);
Route::post('ajaxImageUpload', ['as'=>'ajaxImageUpload','uses'=>'AjaxImageUploadController@ajaxImageUploadPost']);
// dropzone upload
Route::get('dropzone', 'HomeController@dropzone');
Route::post('dropzone/store', ['as'=>'dropzone.store','uses'=>'HomeController@dropzoneStore']);
