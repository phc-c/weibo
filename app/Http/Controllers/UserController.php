<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(){
        return view('user.create');
    }

    public function show(User $user){
        return view('user.show',compact('user'));
    }

    public function store(Request $request)
    {
        /**
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
         * 获取用户输入的信息
         *  User::create创建成功后会返回一个用户对象
        */
        $user = User::create(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
            ]);

        /**
         * 顶部显示注册成功的信息
         */
        session()->flash('success','欢迎，您已经注册成功');

        /**
         * 重定向到user.show用户展示信息界面
         * 通过路由跳转实现数据绑定$user
         */
        return redirect()->route('users.show',[$user]);
    }

}
