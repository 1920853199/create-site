<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsAttrInfo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','goods_id','attr_value_id','price','original_price','stock','sku'
    ];

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
