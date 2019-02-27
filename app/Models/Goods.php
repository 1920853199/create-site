<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','name','type_id','summary','sku','price','original_price','image','stock','is_new','is_hot','is_recommend','sales'
    ];

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
