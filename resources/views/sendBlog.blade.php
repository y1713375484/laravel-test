{{--个人中心博客发布--}}
@extends("home")
@section('css')
    <link href="https://unpkg.com/@wangeditor/editor@latest/dist/css/style.css" rel="stylesheet">
    <style>
        #editor—wrapper {
            border: 1px solid #ccc;
            z-index: 100; /* 按需定义 */
        }
        #toolbar-container {
            border-bottom: 1px solid #ccc;
        }
        #editor-container {
            height: 500px;
        }
    </style>
@endsection

@section('sendBlogContent')
<h5>发布新博客</h5>
<form>
    <div class="mb-3">
        <label for="title" class="form-label" >标题</label>
        <input type="text" class="form-control" id="title" placeholder="输入博客标题">
    </div>

    <div class="mb-3">
        <label for="title" class="form-label" >描述</label>
        <input type="text" class="form-control" id="desc" placeholder="输入博客描述">
    </div>

    <div class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <label for="datetime">选择时间：</label>
                <input type="datetime-local" id="datetime" class="form-control">
            </div>
        </div>
    </div>

    <label for="title" class="form-label">内容</label>

    <div id="editor—wrapper">
        <div id="toolbar-container"><!-- 工具栏 --></div>
        <div id="editor-container"><!-- 编辑器 --></div>
    </div>
    <button type="button" class="btn btn-primary" id="sendBtn">发布</button>
</form>
@endsection
@section('script')
    <script src="https://unpkg.com/@wangeditor/editor@latest/dist/index.js"></script>
    <script>


        const { createEditor, createToolbar } = window.wangEditor

        const editorConfig = {
            placeholder: 'Type here...',
            onChange(editor) {
                const html = editor.getHtml()
                console.log('editor content', html)
                // 也可以同步到 <textarea>
            },
            MENU_CONF: {}
        }
        //图片上传
        editorConfig.MENU_CONF['uploadImage'] = {
            server: '{{route("uploadBlogImg")}}',
            // form-data fieldName ，默认值 'wangeditor-uploaded-image'
            fieldName: 'blogImg',

            // 单个文件的最大体积限制，默认为 2M
            maxFileSize: 1 * 1024 * 1024, // 1M

            // 最多可上传几个文件，默认为 100
            maxNumberOfFiles: 10,

            // 选择文件时的类型限制，默认为 ['image/*'] 。如不想限制，则设置为 []
            allowedFileTypes: ['image/*'],
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // 添加 CSRF 令牌
            },

            // 跨域是否传递 cookie ，默认为 false

            // 超时时间，默认为 10 秒
            timeout: 5 * 1000, // 5 秒
        }

        const editor = createEditor({
            selector: '#editor-container',
            html: '<p><br></p>',
            config: editorConfig,
            mode: 'default', // or 'simple'
        })

        const toolbarConfig = {}

        const toolbar = createToolbar({
            editor,
            selector: '#toolbar-container',
            config: toolbarConfig,
            mode: 'default', // or 'simple'
        })



    </script>
<script>
    {{--  判断当前是修改博客还是发布博客1为发布博客2为修改博客，修改博客需要填充修改的内容  --}}
        @if($type==2)
            editor.setHtml(@json($blog->html_content));//使用json转义防止无法显示
            $("#title").val("{{$blog->title}}")
            $("#desc").val("{{$blog->desc}}")
            $("#datetime").val("{{$blog->time}}")
        @endif




    $("#sendBtn").click(function () {

        if (editor.getText()==""||$("#title").val()==""){
            alert("博客标题和内容不能为空")
            return
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            //根据type判断当前是发布博客还是更新博客
            url: '{{$type==1 ? route("blog.store") : route("blog.update",["blog"=>$blog->id])}}', // 请求地址
            method: '{{$type==1 ? "POST" : "PUT"}}',     // 请求方法
            data: {             // 请求数据
                title: $("#title").val(),
                content: editor.getText(),
                html_content:editor.getHtml(),
                desc:$("#desc").val(),
                dateTime:$("#datetime").val()
            },

            success: function(response) {
                alert(response.message)
                if(response.code>0){
                    editor.setHtml('')
                    $("#title").val("")
                    $("#desc").val("")
                    $("#datetime").val("")
                }
                //console.log('成功:', response);
            },
            error: function(xhr, status, error) {
                console.error('失败:', error);
            }
        });
    })
</script>
@endsection
