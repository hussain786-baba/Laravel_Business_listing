<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
// Route::get('/linkstorage', function () {
//     $targetFolder = storage_path('app/public');
//     $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
//     symlink($targetFolder,$linkFolder);
// });


Route::get('/',  [\App\Http\Controllers\HomeController::class , 'index'])->name('homepage');
Route::get('properties',  [\App\Http\Controllers\PropertyController::class , 'index'])->name('property.index');
Route::get('properties/detail/{property:slug}',  [\App\Http\Controllers\PropertyController::class , 'show'])->name('property.show');
Route::get('properties/category/{category:slug}',  [\App\Http\Controllers\CategoryController::class , 'index'])->name('category.index');
Route::get('agents',  [\App\Http\Controllers\AgentController::class , 'index'])->name('agent.index');
Route::get('contact',  [\App\Http\Controllers\ContactController::class , 'index'])->name('contact.index');
Route::post('contact',  [\App\Http\Controllers\ContactController::class , 'store'])->name('contact.store');
Route::get('posts',  [\App\Http\Controllers\PostController::class , 'index'])->name('post.index');
Route::get('adds',  [\App\Http\Controllers\AddController::class , 'index'])->name('add.index');

Route::get('search',  [\App\Http\Controllers\SearchController::class , 'searchProperty'])->name('search.searchProperty');

Route::group(['middleware' => 'isAdmin','prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('welcome', function() {
        return view('admin.welcome');
    })->name('welcome.index');
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
    
    // user management
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    // property management
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('properties', \App\Http\Controllers\Admin\PropertyController::class);
    Route::resource('properties.features', \App\Http\Controllers\Admin\FeatureController::class);
    Route::resource('properties.galleries', \App\Http\Controllers\Admin\GalleryController::class);
    Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class)->only('index','destroy');
    Route::get('agents/{user:id}', [\App\Http\Controllers\Admin\AgentController::class, 'edit'])->name('agents.edit');
    Route::put('agents/{user:id}', [\App\Http\Controllers\Admin\AgentController::class, 'update'])->name('agents.update');

    
    // blog management
    
    Route::resource('blog_categories',\App\Http\Controllers\Admin\Blog_CategoriesController::class);
    Route::resource('blogpost', \App\Http\Controllers\Admin\PostController::class);
    // Route::resource('properties.features', \App\Http\Controllers\Admin\FeatureController::class);
    // Route::resource('properties.galleries', \App\Http\Controllers\Admin\GalleryController::class);
    // Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class)->only('index','destroy');
    // Route::get('agents/{user:id}', [\App\Http\Controllers\Admin\AgentController::class, 'edit'])->name('agents.edit');
    // Route::put('agents/{user:id}', [\App\Http\Controllers\Admin\AgentController::class, 'update'])->name('agents.update');
    
    // Add management
     
    Route::resource('addcategories', \App\Http\Controllers\Admin\AddcategoryController::class);
    Route::resource('adds', \App\Http\Controllers\Admin\AddController::class);
    Route::resource('adds.addfeatures', \App\Http\Controllers\Admin\AddfeatureController::class);
    Route::resource('adds.addgalleries', \App\Http\Controllers\Admin\AddgalleryController::class);
    
    // Route::get('agents/{user:id}', [\App\Http\Controllers\Admin\AgentController::class, 'edit'])->name('agents.edit');
    // Route::put('agents/{user:id}', [\App\Http\Controllers\Admin\AgentController::class, 'update'])->name('agents.update');

    


});

Auth::routes();

