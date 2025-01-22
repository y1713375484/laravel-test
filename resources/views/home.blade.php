{{--个人中心选项卡--}}
@extends('layouts.app')
@section('css')
    @yield('css')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- 选项卡导航 -->
                            <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $activeTab === 'userUpdateView' ? 'active' : '' }}" href="{{route('userUpdate.view')}}">修改个人信息</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $activeTab === 'sendBolgView' ? 'active' : '' }}" href="{{ route('sendBlog.view') }}">发布新博客</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $activeTab === 'blogsList' ? 'active' : '' }}" href="{{route('showList')}}">查看博客列表</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">退出登录</a>
                                </li>
                            </ul>

                        <!-- 选项卡内容 -->
                        <div class="tab-content mt-3" id="dashboardTabsContent">
                            <!-- 修改个人信息 -->
                            <div class="tab-pane fade show {{$activeTab=="userUpdateView" ? "active" :""}}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @yield('editInfoContent')
                            </div>

                            <!-- 发布新博客 -->
                            <div class="tab-pane fade show {{$activeTab=="sendBolgView" ? "active" :""}}" id="new-post" role="tabpanel" aria-labelledby="new-post-tab">
                                @yield('sendBlogContent')
                            </div>

                            <!-- 查看博客列表 -->
                            <div class="tab-pane fade show {{$activeTab=="blogsList" ? "active" :""}}" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                @yield('blogsListContent')
                            </div>
                        </div>

                        <!-- 退出登录表单 -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@yield('script')
@endsection
