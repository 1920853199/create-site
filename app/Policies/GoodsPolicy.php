<?php


namespace App\Policies;


use App\Models\Goods;
use App\Models\User;

/**
 * 授权策略
 * Class GoodsType
 * @package Wanglelecc\Laracms\Policies
 */
class GoodsPolicy extends Policy
{

    public function index(User $user,Goods $goods)
    {
        return $user->can('manage_goods');
    }

    public function create(User $user,Goods $goods)
    {
        return $user->can('manage_goods');
    }

    public function update(User $user, Goods $goods)
    {
        return $user->can('manage_goods');
    }

    public function destroy(User $user, Goods $goods)
    {
        return $user->can('manage_goods');
    }
}
