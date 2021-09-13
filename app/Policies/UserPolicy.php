<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
/*    public function __construct()
    {
        //
    }*/

    /*
     * 授权策略 手动授权和自动授权
     * 在用户未经授权进行操作时返回403禁止访问异常
     * 第一个参数为当前登录用户实例，第二个参数为要进行授权的用户实例
     * 当两个id相等时用户授权通过，可进行下一个操作
     * */
    public function update(User $currentUser,User $user)
    {
        return $currentUser->id===$user->id;
    }
}
