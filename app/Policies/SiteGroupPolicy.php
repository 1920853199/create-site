<?php


namespace App\Policies;



use App\Models\SiteGroup;
use App\Models\User;

/**
 * 站点模块授权策略
 * Class SitePolicy
 * @package Wanglelecc\Laracms\Policies
 */
class SiteGroupPolicy extends Policy
{

    public function index(User $user,SiteGroup $group)
    {
        return $user->can('manage_website_group');
    }

    public function create(User $user, SiteGroup $group)
    {
        return $user->can('manage_website_group');
    }

    public function update(User $user, SiteGroup $group)
    {
        return $user->can('manage_website_group');
    }

    public function destroy(User $user, SiteGroup $group)
    {
        return $user->can('manage_website_group');
    }
}
