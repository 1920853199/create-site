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

use App\Models\GoodsCategory;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


/**
 * Class GoodsCategoryObserver
 * @package App\Observers
 */
class GoodsCategoryObserver
{
    public function creating(GoodsCategory $goodsCategory)
    {
        $goodsCategory->created_op || $goodsCategory->created_op = Auth::id();
    }

    public function updating(GoodsCategory $goodsCategory)
    {
    }
    
    public function updated(GoodsCategory $goodsCategory){

    }

    public function saving(GoodsCategory $goodsCategory){
    }

    public function saved(GoodsCategory $goodsCategory){

    }

    public function deleted(GoodsCategory $goodsCategory)
    {

    }
}