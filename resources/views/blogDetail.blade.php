{{--博客详情页面--}}
@extends('layouts.indexTemp')
@section('css')
    <style>
        /* 重置样式 */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        img{
            width: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1rem 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .article-detail {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1.5rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .article-detail h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .article-detail .meta {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1.5rem;
        }

        .article-detail .article-image {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 1.5rem;
        }

        .article-detail .content {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .article-detail .content p {
            margin-bottom: 1rem;
        }

        .back-to-home {
            display: inline-block;
            background-color: #007BFF;
            color: #fff;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-to-home:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>

{{--highlightJS代码高亮插件--}}
    <link href="{{asset('css/highlight.css')}}" rel="stylesheet" />
    <script src="{{ asset('js/highlight.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
        });
    </script>

@endsection
@section('content')
    <main>
        <article class="article-detail">
{{--            <h1>文章标题</h1>--}}
{{--            <p class="meta">作者: 张三 | 发布日期: 2023-10-01</p>--}}
{{--            <img src="https://via.placeholder.com/800x400" alt="文章图片" class="article-image">--}}
{{--            <div class="content">--}}
{{--                <p>这是文章的第一段内容。这是文章的第一段内容。这是文章的第一段内容。这是文章的第一段内容。这是文章的第一段内容。</p>--}}
{{--                <p>这是文章的第二段内容。这是文章的第二段内容。这是文章的第二段内容。这是文章的第二段内容。这是文章的第二段内容。</p>--}}
{{--                <p>这是文章的第三段内容。这是文章的第三段内容。这是文章的第三段内容。这是文章的第三段内容。这是文章的第三段内容。</p>--}}
{{--                <p>这是文章的第四段内容。这是文章的第四段内容。这是文章的第四段内容。这是文章的第四段内容。这是文章的第四段内容。</p>--}}
{{--            </div>--}}
            <h1>{{$blog->title}}</h1>
            <p class="meta">作者: {{$blog->author}} | 发布日期: {{$blog->time}}</p>
            <div class="content">
               {!! $blog->html_content !!}
            </div>
            <a href="/" class="back-to-home">返回首页</a>
        </article>
    </main>
@endsection
