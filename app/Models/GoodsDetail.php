<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','keyword','describe','content'
    ];

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
