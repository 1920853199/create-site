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

use App\Models\GoodsDetail;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


/**
 * Class GoodsDetailObserver
 * @package App\Observers
 */
class GoodsDetailObserver
{
    public function creating(GoodsDetail $goodsDetail)
    {
        $goodsDetail->created_op || $goodsDetail->created_op = Auth::id();
    }

    public function updating(GoodsDetail $goodsDetail)
    {
    }
    
    public function updated(GoodsDetail $goodsDetail){

    }

    public function saving(GoodsDetail $goodsDetail){
    }

    public function saved(GoodsDetail $goodsDetail){

    }

    public function deleted(GoodsDetail $goodsDetail)
    {

    }
}