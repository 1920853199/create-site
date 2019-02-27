<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsAttr extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','name','sort','is_upload_image','type_id'
    ];

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * 删除
     * @param $type_id
     * @return bool|null
     */
    public function deleteValue($type_id){
        return GoodsAttr::where('type_id', $type_id)->delete();
    }
}
