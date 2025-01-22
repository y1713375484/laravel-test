<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{

    /*
     * 修改个人信息页面
     */
    public function userUpdateView(){
        return view("editInfo",["activeTab"=>"userUpdateView"]);
    }

    /*
     * 修改个人信息操作提交
     */
    public function userUpdate(Request $request){
        $email=$request->input("email");
        $name=$request->input("name");
        $password=$request->input("password");
        // 正则表达式
        $pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/';

        // 使用 preg_match 进行匹配
        if (!preg_match($pattern, $email)) {
            return response()->json([
                "code"=>-1,
                "message"=>"当前输入的邮箱不合法"
            ]); // 邮箱不合法
        }

        if (empty($name)){
            return response()->json([
                "code"=>-1,
                "message"=>"当前输入的姓名为空"
            ]);
        }

        if (empty($password)){
            return response()->json([
                "code"=>-1,
                "message"=>"当前输入的密码为空"
            ]);
        }

       $user = User::first();
       if(Hash::check($password, $user->password)){
           return response()->json([
               "code"=>-1,
               "message"=>"当前输入的密码与旧密码一致"
           ]);
       }
        try {
            $user->name=$name;
            $user->password=Hash::make($password);//密码加密存储
            $user->email=$email;
            $user->save();
            return response()->json([
                "code"=>200,
                "message"=>"信息修改成功"
            ]);
        }catch (\Exception $exception){
            return response()->json([
                "code"=>-1,
                "message"=>"信息修改失败"
            ]);
        }



    }


    /*
    * 显示博客列表
    */
    public function showList(){
        //根据时间查询最新的博客内容，并分页展示
        $blogs = Blogs::orderByRaw('time desc')->paginate(3);
        return view("blogsList",["activeTab"=>"blogsList",'blogs' => $blogs]);
    }

    /*
     * 个人中心发布博客页面
     */
    public function sendBolgView(){
        //type=1代表当前发布博客，发布博客页面会更具类型进行不同操作
        return view("sendBlog",["activeTab"=>"sendBolgView","type"=>1,"blog"=>""]);
    }


}
