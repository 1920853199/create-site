<?php


namespace App\Policies;



use App\Models\GoodsAttr;
use App\Models\User;

/**
 * 站点模块授权策略
 * Class GoodsAttr
 * @package Wanglelecc\Laracms\Policies
 */
class GoodsAttrPolicy extends Policy
{

    public function index(User $user,GoodsAttr $goodsAttr)
    {
        return $user->can('manage_goods_attr');
    }

    public function create(User $user, GoodsAttr $goodsAttr)
    {
        return $user->can('manage_goods_attr');
    }

    public function update(User $user, GoodsAttr $goodsAttr)
    {
        return $user->can('manage_goods_attr');
    }

    public function destroy(User $user, GoodsAttr $goodsAttr)
    {
        return $user->can('manage_goods_attr');
    }
}
