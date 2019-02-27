<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsAttrValue extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','attr_id','attr_value','attr_image'
    ];

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * 删除
     * @param $attr_id
     * @return bool|null
     */
    public function deleteValue($attr_id){
        return GoodsAttrValue::where('attr_id', $attr_id)->delete();
    }
}
