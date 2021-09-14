<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    /*
     * 给用户设置权限
     * 只有登录了的用户才能访问edit和update动作
     * 登录了自己的用户只能修改自己的信息，而不能修改他人的信息
     *
     * 使用laravel提供的Auth中间件过滤edit和update动作
     *
     * auth只允许登录用户进行的操作
     * guest只允许未登录用户进行的操作
     * 只在本页面有效
     *
     *此处调用的create()方法访问的是user.create注册页面
     * */
    public function __construct()
    {
        $this->middleware('auth',
            [
                'except' => ['show', 'create', 'store', 'index']
            ]);
        $this->middleware('guest',
            [
                'only' => ['create']
            ]);
    }

   /*
    * 注册页面
    * */
    public function create()
    {
        return view('user.create');
    }

    /*
     * 显示用户信息页面
     * */
    public function show(User $user)
    {
        /*
         * 此处跳转的是resources/user/show.blade/php页面
         * */
        return view('user.show', compact('user'));
    }

    /*
     * 用户注册信息认证页面
     * */
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
        $this->validate($request,
            [
                'name' => 'required|unique:users|max:50',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|confirmed|min:6',
            ]);

        /**
         * 用$request获取用户输入的信息
         *  User::create创建成功后会返回一个用户对象
         */
        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

        /**
         * 用户注册成功后自动登录
         * Auth::login($user)
         */
        Auth::login($user);

        /**
         * 顶部显示注册成功的信息
         */
        session()->flash('success', '欢迎，您将在这里开始一段美好的旅程~');

        /**
         * 重定向到user.show用户展示信息界面
         * 通过路由跳转实现数据绑定$user
         */
        return redirect()->route('users.show', [$user]);
    }

    /**
     * 编辑用户界面
     * authorize()方法验证用户授权策略
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('user.edit', compact('user'));
    }

    /**
     * 更新用户信息
     */
    public function update(User $user, Request $request)
    {
        /*
         * authorize()方法验证用户授权策略
         * */
        $this->authorize('update', $user);

        /*
         * 将获取到的输入数据进行认证
         * */
        $this->validate($request,
            [
                'name' => 'required|max:50',
                'password' => 'nullable|confirmed|min:6'
            ]);

        /*
         * 认证通过后更新数据库里用户信息
         * 如果不想进行密码更新也可以 输入密码的情况
         *   if($request->password)
            $data['password'] = $request->password;
         * 密码和姓名均修改也可以
         * */
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        /*
         * session()输出提示信息
         * */
        session()->flash('success', '个人资料修改成功');

        /*
         * 更新完成后将信息重定向到user.show页面
         * 此处跳转到的是UserController/users资源控制器
         * */
        return redirect()->route('users.show', $user->id);

    }

    /*
     * 用户列表
     * paginate()每一页数据的条数
     * */
    public function index()
    {
        $user = User::all();
        return view('user.index',compact('user'));
    }

}
