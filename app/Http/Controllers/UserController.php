<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }

    public function store(Request $request)
    {
        /**
         * 用户认证
         * 对小白较为友好的的验证表单方式validate
         * 第一个参数为用户输入的数据,第二个参数为验证的规则
         * 存在性验证 require验证是否为空
         * 唯一性验证 unique:users
         * 长度验证 min|max
         * 格式验证 email(验证邮箱格式)
         * 密码匹配验证 confirmed
         * 验证通过之后再存入数据库
         */
        $this -> validate($request,
            [
                'name'=>'required|unique:users|max:50',
                'email'=>'required|email|unique:users|max:255',
                'password'=>'required|confirmed|min:6',
            ]);

        /**
         * 用$request获取用户输入的信息
         *  User::create创建成功后会返回一个用户对象
        */
        $user = User::create(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
            ]);

        /**
         * 用户注册成功后自动登录
         * Auth::login($user)
         */
        Auth::login($user);

        /**
         * 顶部显示注册成功的信息
         */
        session()->flash('success','欢迎，您将在这里开始一段美好的旅程~');

        /**
         * 重定向到user.show用户展示信息界面
         * 通过路由跳转实现数据绑定$user
         */
        return redirect()->route('user.show',[$user]);
    }

}
