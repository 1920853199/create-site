<?php


namespace App\Policies;



use App\Models\GoodsType;
use App\Models\User;

/**
 * 站点模块授权策略
 * Class GoodsType
 * @package Wanglelecc\Laracms\Policies
 */
class GoodsTypePolicy extends Policy
{

    public function index(User $user,GoodsType $goodsType)
    {
        return $user->can('manage_goods_attr');
    }

    public function create(User $user, GoodsType $goodsType)
    {
        return $user->can('manage_goods_attr');
    }

    public function update(User $user, GoodsType $goodsType)
    {
        return $user->can('manage_goods_attr');
    }

    public function destroy(User $user, GoodsType $goodsType)
    {
        return $user->can('manage_goods_attr');
    }
}
