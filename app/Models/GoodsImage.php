<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsImage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','goods_id','image_url'
    ];

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
