<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class blogController extends Controller
{




    /**
     * 提交新的博客数据操作
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title=$request->post("title");
        $content=$request->post("content");
        $html_content=$request->post("html_content");
        $desc=$request->post("desc");
        $dateTime=$request->post("dateTime");

        if(empty($title)||empty($content)){
            return response()->json([
                "code"=>-1,
                "message"=>"博客标题和内容不能为空"
            ]);
        }

        if (empty($dateTime)){
            date_default_timezone_set('Asia/Shanghai');
            $dateTime = date("Y-m-d H:i:s");
        }

        if (empty($desc)){
            $desc=substr($content, 0, 15);
        }

        $blog = new Blogs();
        $blog->title=$title;
        $blog->desc=$desc;
        $blog->content=$content;
        $blog->html_content=$html_content;
        $blog->time=$dateTime;
        $blog->author=Auth::user()->name;
        $blog->save();

        return response()->json([
            "code"=>200,
            "message"=>"发布成功"
        ]);
    }

    /**
     * 查看某一篇博客
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog=Blogs::find($id);
        return view('blogDetail',["blog"=>$blog]);
    }



    /**
     * 编辑某一篇博客
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blogs::find($id);
        //复用博客发布模板，type修改为2
        return view("sendBlog",["activeTab"=>"sendBolgView","type"=>2,"blog"=>$blog]);
    }

    /**
     * 更新某一篇博客
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title=$request->post("title");
        $content=$request->post("content");
        $html_content=$request->post("html_content");
        $desc=$request->post("desc");
        $dateTime=$request->post("dateTime");

        if(empty($title)||empty($content)){
            return response()->json([
                "code"=>-1,
                "message"=>"博客标题和内容不能为空"
            ]);
        }

        if (empty($dateTime)){
            date_default_timezone_set('Asia/Shanghai');
            $dateTime = date("Y-m-d H:i:s");
        }

        if (empty($desc)){
            $desc=substr($content, 0, 15);
        }

        $blog =  Blogs::find($id);
        $blog->title=$title;
        $blog->desc=$desc;
        $blog->content=$content;
        $blog->html_content=$html_content;
        $blog->time=$dateTime;
        $blog->author=Auth::user()->name;
        $blog->save();

        return response()->json([
            "code"=>200,
            "message"=>"更新成功"
        ]);
    }

    /**
     * 删除某一篇博客
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Blogs::where("id", "=", $id)->delete();
            return response()->json([
                "code"=>200,
                "message"=>"删除成功"
            ]);
        }catch (\Exception $exception){
            return response()->json([
                "code"=>-1,
                "message"=>"删除失败"
            ]);
        }

    }
}
