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
use App\Models\Template;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


/**
 * 模板观察者
 * Class TemplateObserver
 * @package App\Observers
 */
class TemplateObserver
{
    public function creating(Template $template)
    {
        $template->status = '0';
        $template->created_op || $template->created_op = Auth::id();
    }

    public function updating(Template $template)
    {
    }
    
    public function updated(Template $template){

    }

    public function saving(Template $template){
    }

    public function saved(Template $template){

    }

    public function deleted(Template $template)
    {

    }
}