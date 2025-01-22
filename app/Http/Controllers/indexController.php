<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class indexController extends Controller
{
    /*
     * 博客首页
     */
    public function index(){
        //根据时间查询最新的博客内容，并分页展示
        $blogs = Blogs::orderByRaw('time desc')->paginate(3);
        return view("index",['blogs' => $blogs]);
    }
}
