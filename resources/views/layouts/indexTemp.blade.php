{{--首页模板--}}
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的博客-@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<header>
    <nav>
        <div class="logo">我的博客</div>
        <ul class="nav-links">
            <li><a href="/">首页</a></li>
            <li><a href="#">关于</a></li>
            <li><a href="#">联系</a></li>
            @if(\Illuminate\Support\Facades\Auth::check())
                <li><a href="{{route("userUpdate.view")}}">{{\Illuminate\Support\Facades\Auth::user()->name}}的个人中心</a></li>
            @else
                <li><a href="/login">登录</a></li>
            @endif

        </ul>
    </nav>
</header>

<main>
    <section class="hero">
        <h1>欢迎来到我的博客</h1>
        <p>在这里分享我的想法和见解</p>
    </section>

    <section class="blog-posts">
        @yield('content')

    </section>
</main>

<footer>
    <p>&copy; 2025 我的博客——by岛屿可以找到海.</p>
</footer>
</body>
</html>
