@extends('layouts.default')
@section('title','首页')
@section('content')
    <div claSS="jumbotron">
        <h1>首页</h1>
        <p class="lead">你现在看到的是</p>
        <p>一切从这里开始</p>
        <p>
            <a class="btn btn-lg btn-success"
               href="{{route('signup')}}"
               role="button">现在注册</a>
        </p>
    </div>
@stop
