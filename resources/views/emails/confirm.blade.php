@extends('layouts.default')
@section('title','点击确认链接')
@section('content')
    <h1>感谢您在weibo网站进行注册!</h1>
    <p>请点击一下链接完成注册
        <a href="{{route('confirm_email',
          $user->activation_token)}}">
            {{route('confirm_email',$user->activation_token)}}
        </a>
    </p>
    <p>如果不是您本人操作，请忽略此操作</p>
@stop
