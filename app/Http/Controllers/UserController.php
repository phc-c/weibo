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

    public function store(Request $request){
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
                'name'=>'require|unique:users|max:50',
                'email'=>'require|email|unique:users|max:255',
                'password'=>'require|confirmed|min:6',
            ]);
        return;
    }

}
