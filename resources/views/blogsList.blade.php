{{--个人中心博客列表--}}
@extends("home")
@section('blogsListContent')
    <h5>博客列表</h5>
    <ul class="list-group">
        @foreach ($blogs as $blog)

            <li class="list-group-item">
                <h6>{{ $blog->title }}</h6>

                <p>{{ $blog->desc }}</p>
                <small class="text-muted">发布时间：{{$blog->time}}</small>
                <button type="button" class="btn btn-primary"><a class="text-reset text-decoration-none" href="{{route("blog.show",["blog"=>$blog->id])}}">查看博客</a></button>
                <button type="button" class="btn btn-success"><a class="text-reset text-decoration-none" href="{{route("blog.edit",["blog"=>$blog->id])}}">修改博客</a></button>
                <button type="button" class="btn btn-danger" onclick="delBlog({{$blog->id}})">删除博客</button>
            </li>
        @endforeach
{{--        <li class="list-group-item">--}}
{{--            <h6>博客标题 1</h6>--}}
{{--            <p>这是第一篇博客的内容摘要。</p>--}}
{{--            <small class="text-muted">发布时间：2023-10-01</small>--}}
{{--        </li>--}}
{{--        <li class="list-group-item">--}}
{{--            <h6>博客标题 2</h6>--}}
{{--            <p>这是第二篇博客的内容摘要。</p>--}}
{{--            <small class="text-muted">发布时间：2023-10-05</small>--}}
{{--        </li>--}}
{{--        <li class="list-group-item">--}}
{{--            <h6>博客标题 3</h6>--}}
{{--            <p>这是第三篇博客的内容摘要。</p>--}}
{{--            <small class="text-muted">发布时间：2023-10-10</small>--}}
{{--        </li>--}}
            {{ $blogs->links() }}
    </ul>
@endsection
@section('script')
    <script>
        function delBlog(id) {
            $.ajax({
                url: '{{ route("blog.destroy", ["blog" => "__ID__"]) }}'.replace('__ID__', id), // 动态替换 ID
                method: 'DELETE',     // 请求方法
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // 添加 CSRF 令牌
                },
                success: function(response) {
                    alert(response.message)
                    if(response.code>0){
                        location.reload(true);//页面刷新
                    }
                    //console.log('成功:', response);
                },
                error: function(xhr, status, error) {
                    console.error('失败:', error);
                }
            });
        }
    </script>
@endsection
