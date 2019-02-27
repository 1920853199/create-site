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

use App\Models\Goods;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


/**
 * Class GoodsObserver
 * @package App\Observers
 */
class GoodsObserver
{
    public function creating(Goods $goods)
    {
        $goods->created_op || $goods->created_op = Auth::id();
        $goods->is_new = '1';
    }

    public function updating(Goods $goods)
    {
    }
    
    public function updated(Goods $goods){

    }

    public function saving(Goods $goods){
    }

    public function saved(Goods $goods){

    }

    public function deleted(Goods $goods)
    {

    }
}