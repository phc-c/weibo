@extends('layouts.default')
@section('title','注册')
@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>登录</h5>
            </div>
            <div class="card-body">

                @include('shared._errors')

                <form method="POST" action="{{route('store')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <lable for="name">名称</lable>
                        <input type="text" name="name"
                               class="form-control"
                               value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <lable for="email">邮箱</lable>
                        <input type="text" name="email"
                               class="form-control"
                               value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <lable for="password">密码</lable>
                        <input type="password" name="password"
                               class="form-control"
                               value="{{old('password')}}">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="remember"
                                   class="form-check-input"
                                   id="exampleCheck1">
                            <lable class="form-check-label"
                                   for="exampleCheck1">记住我
                            </lable>
                        </div>
                    </div>

                    <button type="submit"
                            class="btn btn-primary">登录
                    </button>
                </form>

                <hr>

                <p>还没账号？
                    <a href="{{route('signup')}}" class="text-primary">现在注册</a>
                </p>
            </div>
        </div>
    </div>
@stop
