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


Route::get('/welcome', function () {
    date_default_timezone_set('Asia/Shanghai');
    $dateTime = date("Y-m-d H:i:s");
    print_r($dateTime);
});



// 博客首页
Route::get("/",[\App\Http\Controllers\indexController::class,"index"])
    ->name("blog.index");



// 博客增删改查操作
Route::resource("blog",\App\Http\Controllers\blogController::class);


// 个人中心
Route::prefix("/home")->group(function (){

    //更新个人信息页面
    Route::get("/updateView",[\App\Http\Controllers\userController::class,"userUpdateView"])->name("userUpdate.view");
    //更新个人信息操作
    Route::patch("/Update",[\App\Http\Controllers\userController::class,"userUpdate"])->name("userUpdate.action");
    //创建新博客页面
    Route::get("/sendBold",[\App\Http\Controllers\userController::class,"sendBolgView"])->name("sendBlog.view");

    //博客列表
    Route::get("/blogList",[\App\Http\Controllers\userController::class,"showList"])->name("showList");

});


//文本编辑器图片上传
Route::post("/uploadBlogImg",[\App\Http\Controllers\uploadController::class,"uploadBlogImg"])
    ->name("uploadBlogImg");




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
