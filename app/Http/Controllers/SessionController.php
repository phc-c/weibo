<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use function PHPUnit\Framework\once;

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
     * 登录时认证用户身份
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
         *
         * intended()重定向到上一次请求尝试访问的页面
         * 接收一个默认的地址，如果上一次访问为空则跳到默认地址
         */
        if (Auth::attempt($credentials,
            $request->has('remember'))) {
            /*
             * 用户没激活登录视为认证失败(前端认证通过，但后端认证不通过)
             * Auth::$user->activated是激活账户验证
             * */
//            if (Auth::user->activated) {
                session()->flash('success', '欢迎回来！');
                /*
                 * 默认地址为方法users.show()指向的路由user.show
                 * */
                $fallback = route('users.show', [Auth::user()]);
                return redirect()->intended($fallback);
            }
/*            else {
                Auth::logout();
                session()->flash('warning', '对不起您的账户未激活，
                请检查邮箱中的注册邮件进行激活！');
            }*/
//        }
        else {
            /*
             * 前端认证不通过
             * */
            session()->flash('danger', '对不起您输入的邮箱和密码不匹配！');
            return redirect()->back()->withInput();
        }
    }

    /*
 * 退出登录
 * 用Auth::logout()
 * */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出登录！');
        return redirect()->route('home');
    }

    /*
     * 只让未登录的用户才能访问登录页面create
     * guest允许未登录用户进行的操作
     * 只在本页面有效
     *
     * 此处调用的create()方法访问的是session.create登录页面
     * */
    public function __construct()
    {
        $this->middleware('guest',
            [
                'only' => ['create']
            ]);
    }

}
