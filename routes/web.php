<?php

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
//Frontend
Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index');

// Category, Brand homepage
Route::get('/danh-muc-san-pham/{category_id}', 'CategoryProducts@category_by_id');
Route::get('/thuong-hieu-san-pham/{brand_id}', 'BranchProduct@brand_by_id');



//Backend
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@admin_layout');
Route::get('/logout', 'AdminController@logout');

Route::post('/admin_dashboard', 'AdminController@dashboard');

// Category Product
Route::get('/add-category-product', 'CategoryProducts@add_category_product');
Route::get('/all-category-product', 'CategoryProducts@all_category_product');
Route::get('/edit-category-product/{categoryProduct_id}', 'CategoryProducts@edit_category_product');
Route::get('/delete-category-product/{categoryProduct_id}', 'CategoryProducts@delete_category_product');

Route::get('/unactive-category/{categoryProduct_id}', 'CategoryProducts@unactive_category_product');
Route::get('/active-category/{categoryProduct_id}', 'CategoryProducts@active_category_product');

Route::post('/save-category-product', 'CategoryProducts@save_category_product');
Route::post('/update-category-product/{categoryProduct_id}', 'CategoryProducts@update_category_product');

// Branch Product
Route::get('/add-branch-product', 'BranchProduct@add_branch_product');
Route::get('/all-branch-product', 'BranchProduct@all_branch_product');
Route::get('/edit-branch-product/{branchProduct_id}', 'BranchProduct@edit_branch_product');
Route::get('/delete-branch-product/{branchProduct_id}', 'BranchProduct@delete_branch_product');

Route::get('/unactive-branch/{branchProduct_id}', 'BranchProduct@unactive_branch_product');
Route::get('/active-branch/{branchProduct_id}', 'BranchProduct@active_branch_product');

Route::post('/save-branch-product', 'BranchProduct@save_branch_product');
Route::post('/update-branch-product/{branchProduct_id}', 'BranchProduct@update_branch_product');

// Product
Route::get('/add-product', 'ProductController@add_product');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');

Route::post('/save-product', 'ProductController@save_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');