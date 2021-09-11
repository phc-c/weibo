<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionController extends Controller
{
    /**
     * 登录界面
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * 认证用户身份
     */
    public function store(Request $request)
    {
        $credentials = $this->validate($request,
            [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

        /**
         * 查找数据库中的数据
         * 查找到认证成功
         * 查找不到认证失败
         * Auth::user()获取当前登录用户的信息
         * withInput()能获取到模板里old('email')上一次提交内容
         */
        if(Auth::attempt($credentials)){
            session()->flash('success','欢迎回来！');
            return redirect()->route('user.show',[Auth::user()]);
        }else{
            session()->flash('danger','对不起您输入的邮箱和密码不匹配！');
            return redirect()->back()->withInput();
        }
    }

}
