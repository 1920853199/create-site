<?php


namespace App\Policies;


use App\Models\Template;
use App\Models\User;

/**
 * 模板模块授权策略
 * Class SitePolicy
 * @package Wanglelecc\Laracms\Policies
 */
class TemplatePolicy extends Policy
{

    public function index(User $user,Template $template)
    {
        return $user->can('manage_website_template');
    }

    public function create(User $user, Template $template)
    {
        return $user->can('manage_website_template');
    }

    public function update(User $user, Template $template)
    {
        return $user->can('manage_website_template');
    }

    public function destroy(User $user, Template $template)
    {
        return $user->can('manage_website_template');
    }
}
