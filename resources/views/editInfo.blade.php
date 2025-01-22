{{--个人中心修改个人信息--}}
@extends("home")
@section('editInfoContent')
    <h5>修改个人信息</h5>
    <form>
        <div class="mb-3">
            <label for="name" class="form-label">姓名</label>
            <input type="text" class="form-control" id="name" value="John Doe">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">邮箱</label>
            <input type="email" class="form-control" id="email" value="john@example.com">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">新密码</label>
            <input type="password" class="form-control" id="password" placeholder="输入新密码">
        </div>
        <button type="button" class="btn btn-primary" onclick="saveInfo()">保存更改</button>
    </form>
@endsection
@section('script')
    <script>
        function saveInfo() {
           let name=$("#name").val()
            let email=$("#email").val()
            let password=$("#password").val()
            if(name==""||email==""||password==""){
                alert("姓名、邮箱、密码不能为空")
                return
            }
            $.ajax({
                url: '{{route("userUpdate.action")}}', //
                method: 'PATCH',     // 请求方法
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // 添加 CSRF 令牌
                },
                data:{
                  name,
                  email,
                  password
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
