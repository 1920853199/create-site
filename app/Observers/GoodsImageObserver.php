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

use App\Models\GoodsImage;
use Illuminate\Support\Facades\Auth;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored


/**
 * Class GoodsImageObserver
 * @package App\Observers
 */
class GoodsImageObserver
{
    public function creating(GoodsImage $goodsImage)
    {
        $goodsImage->created_op || $goodsImage->created_op = Auth::id();
    }

    public function updating(GoodsImage $goodsImage)
    {
    }
    
    public function updated(GoodsImage $goodsImage){

    }

    public function saving(GoodsImage $goodsImage){
    }

    public function saved(GoodsImage $goodsImage){

    }

    public function deleted(GoodsImage $goodsImage)
    {

    }
}