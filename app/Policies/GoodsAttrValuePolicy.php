<?php


namespace App\Policies;



use App\Models\GoodsAttrValue;
use App\Models\User;

/**
 * 站点模块授权策略
 * Class GoodsAttrValue
 * @package Wanglelecc\Laracms\Policies
 */
class GoodsAttrValuePolicy extends Policy
{

    public function index(User $user,GoodsAttrValue $goodsAttrValue)
    {
        return $user->can('manage_goods_attr');
    }

    public function create(User $user, GoodsAttrValue $goodsAttrValue)
    {
        return $user->can('manage_goods_attr');
    }

    public function update(User $user, GoodsAttrValue $goodsAttrValue)
    {
        return $user->can('manage_goods_attr');
    }

    public function destroy(User $user, GoodsAttrValue $goodsAttrValue)
    {
        return $user->can('manage_goods_attr');
    }
}
