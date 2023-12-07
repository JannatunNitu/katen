<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\postController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SubController;

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
    return view('frontend.homepage');
})->name('frontend');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// *POFILE ROUTES
Route::prefix('/profile')->name('show.')->controller(ProfileController::class)->group(
    function(){
        Route::get('/','ShowProfile')->name('profile');
        Route::put('/Update','UpdateProfile')->name('profile.update');
        Route::put('/Password/Update','UpdatePassword')->name('profile.password.update');
    }
);





// *CATEGORY ROUTES
Route::prefix('/backend/category')->name("category.")->controller(CategoryController::class)->group(
    function(){
        Route::get('/','viewCategory')->name('show');
        Route::post('/store','storeCategory')->name('store');
        Route::get('/edit/{slug}', 'editCategory')->name('edit');
        Route::put('/update/{slug}', 'updateCategory')->name('Update');
        Route::delete('/delete/{id}', 'deleteCategory')->name('Delete');
    }
    
);

// *SUB CATEGORY ROUTES
Route::prefix('/backend/sub-category')->name('subcategory.')->controller(SubController::class)->group(
    function(){
       Route::get('/','viewSubcategory')->name('view');
       Route::get('/store','storeSubcategory')->name('store');
       Route::get('/get-all-sub-category','getSubCategory')->name('get');
    }
);

// *POSTS CATEGORY ROUTES
Route::prefix('/backend/posts')->name('post.')->controller(postController::class)->group(
   function(){
      Route::get('/','addPost')->name('add');
      Route::post('/store','storePost')->name('store');
      Route::get('/all','getAllPost')->name('all');
      Route::get('/update', 'updatePost')->name('update');
   }
);
