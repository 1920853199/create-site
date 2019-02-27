<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

namespace App\Observers;

use App\Http\Requests\Request;
use App\Models\SiteGroup;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


/**
 * 站点观察者
 * Class SiteGroupObserver
 * @package App\Observers
 */
class SiteGroupObserver
{
    public function creating(SiteGroup $group)
    {
        $group->status = '0';
        $group->created_op || $group->created_op = Auth::id();
        $group->template = 'cms';
        $group->template_mobile = 'cms';
    }

    public function updating(SiteGroup $group)
    {
    }
    
    public function updated(SiteGroup $group){

    }

    public function saving(SiteGroup $group){
    }

    public function saved(SiteGroup $group){

    }

    public function deleted(SiteGroup $group)
    {

    }
}