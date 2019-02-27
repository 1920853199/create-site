<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class SiteGroup extends Model
{

    use SoftDeletes;

    public $statusValue = [
        0   => '关闭',
        1   => '启用'
    ];

    protected $fillable = [
        'id','site_name', 'domain','template', 'template_mobile', 'director', 'phone', 'email', 'status', 'created_op'
    ];

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * 域名是否已经存在了
     * @param $host
     * @return bool
     */
    public function isExists($host,$id = ''){

        $where = '';
        if($id){
            $where = "and `id` != {$id}";
        }

        $res = DB::connection('local')->select("select * from lara_site_groups where `domain` = '{$host}' $where");

        if(!empty($res)){
            return false;
        }

        return true;

    }
}
