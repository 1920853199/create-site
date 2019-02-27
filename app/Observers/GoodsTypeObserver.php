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

use App\Models\GoodsType;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


/**
 * Class GoodsAttrObserver
 * @package App\Observers
 */
class GoodsTypeObserver
{
    public function creating(GoodsType $goodsType)
    {
        $goodsType->created_op || $goodsType->created_op = Auth::id();
    }

    public function updating(GoodsType $goodsType)
    {
    }
    
    public function updated(GoodsType $goodsType){

    }

    public function saving(GoodsType $goodsType){
    }

    public function saved(GoodsType $goodsType){

    }

    public function deleted(GoodsType $goodsType)
    {

    }
}