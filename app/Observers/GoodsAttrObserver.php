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

use App\Models\GoodsAttr;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


/**
 * Class GoodsAttrObserver
 * @package App\Observers
 */
class GoodsAttrObserver
{
    public function creating(GoodsAttr $goodsAttr)
    {
        $goodsAttr->created_op || $goodsAttr->created_op = Auth::id();

    }

    public function updating(GoodsAttr $goodsAttr)
    {
    }
    
    public function updated(GoodsAttr $goodsAttr){

    }

    public function saving(GoodsAttr $goodsAttr){
    }

    public function saved(GoodsAttr $goodsAttr){

    }

    public function deleted(GoodsAttr $goodsAttr)
    {

    }
}