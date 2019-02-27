<?php


namespace App\Policies;



use App\Models\GoodsAttrInfo;
use App\Models\User;

/**
 * 站点模块授权策略
 * Class GoodsAttrInfo
 * @package Wanglelecc\Laracms\Policies
 */
class GoodsAttrInfoPolicy extends Policy
{

    public function index(User $user,GoodsAttrInfo $goodsAttrInfo)
    {
        return $user->can('manage_goods_attr');
    }

    public function create(User $user, GoodsAttrInfo $goodsAttrInfo)
    {
        return $user->can('manage_goods_attr');
    }

    public function update(User $user, GoodsAttrInfo $goodsAttrInfo)
    {
        return $user->can('manage_goods_attr');
    }

    public function destroy(User $user, GoodsAttrInfo $goodsAttrInfo)
    {
        return $user->can('manage_goods_attr');
    }
}
