<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class GoodsType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','name'
    ];

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * @param $id Type ID
     * @return \Illuminate\Support\Collection
     */
    public function getAttrAndValues($id){

        $res = DB::table('goods_types')
            ->select('goods_types.name as type_name','goods_attrs.*','goods_attr_values.*','goods_attr_values.id as value_id')
            ->leftJoin('goods_attrs','goods_types.id','=','goods_attrs.type_id')
            ->leftJoin('goods_attr_values','goods_attrs.id','=','goods_attr_values.attr_id')
            ->where([
                ['goods_types.id','=',$id],
                ['goods_attrs.deleted_at','=',NULL],
                ['goods_attr_values.deleted_at','=',NULL],
            ])
            ->get()->toArray();
        return $res;
    }
}
