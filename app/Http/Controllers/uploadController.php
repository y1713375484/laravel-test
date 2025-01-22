<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class uploadController extends Controller{


    /*
     * 博客内的图片上传
     */
    public function uploadBlogImg(Request $request){

        //有文件上传
        if ($request->hasFile('blogImg')) {
            $uploadedFiles = $request->file("blogImg");
            // 指定存储路径
            $destinationPath = 'upload'; // 你可以根据需要修改路径

            // 生成唯一的文件名
            $fileName = time() . '_' . $uploadedFiles->getClientOriginalName();
            $uploadedFiles->move($destinationPath,$fileName);
            return response()->json([
                "errno"=> 0,
                "data"=>[
                    "url"=>"/upload/".$fileName,
                ]
            ]);
        }else{
            return response()->json([
                "errno"=> 1, // 只要不等于 0 就行
                "message"=> "图片上传失败"
            ]);
        }

    }

}
