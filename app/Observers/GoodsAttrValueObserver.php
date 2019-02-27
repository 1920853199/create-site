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

use App\Models\GoodsAttrValue;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


/**
 * Class GoodsAttrInfoObserver
 * @package App\Observers
 */
class GoodsAttrValueObserver
{
    public function creating(GoodsAttrValue $goodsAttrValue)
    {
        $goodsAttrValue->created_op || $goodsAttrValue->created_op = Auth::id();
        $goodsAttrValue->image = '';
    }

    public function updating(GoodsAttrValue $goodsAttrValue)
    {
    }
    
    public function updated(GoodsAttrValue $goodsAttrValue){

    }

    public function saving(GoodsAttrValue $goodsAttrValue){
    }

    public function saved(GoodsAttrValue $goodsAttrValue){

    }

    public function deleted(GoodsAttrValue $goodsAttrValue)
    {

    }
}