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

use App\Models\GoodsAttrInfo;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


/**
 * Class GoodsAttrInfoObserver
 * @package App\Observers
 */
class GoodsAttrInfoObserver
{
    public function creating(GoodsAttrInfo $goodsAttrInfo)
    {
        $goodsAttrInfo->created_op || $goodsAttrInfo->created_op = Auth::id();
    }

    public function updating(GoodsAttrInfo $goodsAttrInfo)
    {
    }
    
    public function updated(GoodsAttrInfo $goodsAttrInfo){

    }

    public function saving(GoodsAttrInfo $goodsAttrInfo){
    }

    public function saved(GoodsAttrInfo $goodsAttrInfo){

    }

    public function deleted(GoodsAttrInfo $GoodsAttrInfo)
    {

    }
}