<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','goods_id','category_id'
    ];

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
