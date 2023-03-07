<?php

use Illuminate\Support\Facades\Route;
// use app\Http\Controllers\customer_controller;
use App\Http\Controllers\customer_controller;
use App\Http\Controllers\admin_controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'admin_staff'], function () {
    Route::get('/admin/dashboard',[admin_controller::class,'admin_dashboard']);
    Route::get('/admin/complains',[admin_controller::class,'admin_complains']);
    Route::post('/admin/edit_complain',[admin_controller::class,'edit_complain']);

});


Route::group(['middleware' => 'admin'], function () {
    // your admin routes go here
    Route::get('/admin/user_management',[admin_controller::class,'user_management']);
    Route::post('/admin/edit_user',[admin_controller::class,'post_edit_user']);
    Route::post('/admin/create_staff',[admin_controller::class,'create_staff']);
    
    Route::post('/admin/add_category',[admin_controller::class,'add_category']);
    Route::get('/admin/delete_cat/{id}',[admin_controller::class,'category_delete']);
    Route::post('/admin/edit_category',[admin_controller::class,'edit_category']);
    Route::post('/admin/edit_subcategory',[admin_controller::class,'edit_subcategory']);
    
    
    Route::post('/admin/add_subcategory',[admin_controller::class,'add_subcategory']);
    Route::get('/admin/delete_subcat/{id}',[admin_controller::class,'subcategory_delete']);
    
    Route::post('/admin/add_state',[admin_controller::class,'add_state']);
    Route::get('/admin/delete_state/{id}',[admin_controller::class,'delete_state']);
    Route::post('/admin/edit_state',[admin_controller::class,'edit_state']);

    Route::post('/admin/create_mapping',[admin_controller::class,'create_mapping']);
    Route::get('/admin/delete_mapping/{id}',[admin_controller::class,'delete_mapping']);
    Route::post('/admin/edit_staff_mapping',[admin_controller::class,'edit_staff_mapping']);
    
    });
Route::group(['middleware' => 'auth'], function () {

    Route::get('/admin/get_category/{id}',[admin_controller::class,'get_category']);
    Route::get('/admin/category',[admin_controller::class,'category_view']);
    
    Route::get('/admin/edit_user/{id}',[admin_controller::class,'edit_user']);
    Route::get('/admin/delete_user/{id}',[admin_controller::class,'delete_user']);
    
    Route::get('/admin/sub_category',[admin_controller::class,'sub_category_view']);
    Route::get('/admin/get_sub_category/{id}',[admin_controller::class,'sub_category_id']);
    Route::get('/admin/get_subcategory_ajax/{id}',[admin_controller::class,'get_subcategory_ajax']);
    Route::get('/admin/get_subcat_ajax/{id}',[admin_controller::class,'get_subcat_ajax']);
    
    
    
    
    Route::get('/admin/state',[admin_controller::class,'state_view']);

    Route::get('/complain-form',[admin_controller::class,'get_complain_form']);
    Route::get('/complain-history',[admin_controller::class,'get_complain_history']);
    Route::post('/create_complain',[admin_controller::class,'create_complain']);
    Route::get('/complain/delete/{id}', [admin_controller::class,'complain_delete']);
    Route::get('/complain/update_status/{id}', [admin_controller::class,'complain_update_status']);


    Route::get('/dashboard',[customer_controller::class,'dashboard']);
    Route::get('/admin/update-profile',[customer_controller::class,'updateprofile']);
    Route::get('/update-profile',[customer_controller::class,'updateprofile']);
    Route::post('/update-profile',[customer_controller::class,'post_update_profile']);
    
    Route::get('/admin/staff',[admin_controller::class,'staff_view']);
    Route::get('/admin/staff_category',[admin_controller::class,'staff_category_view']);

    Route::get('/admin/get_mapping_category/{id}',[admin_controller::class,'get_mapping_category']);

});






// Route::get('/template', function () {
//     return view('template');
// });



Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/logout', function () {
    Session::flush();
    Auth::logout();
    return redirect('/login');
});
Route::post('/login',[customer_controller::class,'login_user']);

Route::get('/register', function () {
    return view('registration');
});
Route::post('/register',[customer_controller::class,'register_user']);

Route::get('/password-rest', function () {
    return view('passwordrest');
});

Route::post('/forget_password',[admin_controller::class,'forget_password']);


