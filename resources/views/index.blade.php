{{--首页内容渲染--}}
@extends('layouts.indexTemp')

@section('css')
    <style>
        .blog-posts {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        .post {
            background-color: #fff;
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .post h2 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .post .meta {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
        }

        .post p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .read-more {
            display: inline-block;
            background-color: #007BFF;
            color: #fff;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 5px;
        }

        .read-more:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('content')

    @foreach ($blogs as $blog)
        <article class="post">
            <h2>{{ $blog->title }}</h2>
            <p class="meta">发布日期: {{$blog->time}} | 作者: {{$blog->author}}</p>
            <p>{{ $blog->desc }}</p>
            <a href="{{route("blog.show",["blog"=>$blog->id])}}" class="read-more">阅读更多</a>

        </article>
    @endforeach
    {{ $blogs->links() }}
{{--            <article class="post">--}}
{{--                <h2>文章标题 1</h2>--}}
{{--                <p class="meta">发布日期: 2023-10-01 | 作者: 张三</p>--}}
{{--                <p>这是文章摘要。这是文章摘要。这是文章摘要。这是文章摘要。这是文章摘要。</p>--}}
{{--                <a href="#" class="read-more">阅读更多</a>--}}
{{--            </article>--}}

{{--            <article class="post">--}}
{{--                <h2>文章标题 2</h2>--}}
{{--                <p class="meta">发布日期: 2023-09-25 | 作者: 李四</p>--}}
{{--                <p>这是文章摘要。这是文章摘要。这是文章摘要。这是文章摘要。这是文章摘要。</p>--}}
{{--                <a href="#" class="read-more">阅读更多</a>--}}
{{--            </article>--}}

{{--            <article class="post">--}}
{{--                <h2>文章标题 3</h2>--}}
{{--                <p class="meta">发布日期: 2023-09-18 | 作者: 王五</p>--}}
{{--                <p>这是文章摘要。这是文章摘要。这是文章摘要。这是文章摘要。这是文章摘要。</p>--}}
{{--                <a href="#" class="read-more">阅读更多</a>--}}
{{--            </article>--}}
@endsection
