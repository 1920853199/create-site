<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Template extends Model
{
    use SoftDeletes;

    public $statusValue = [
        0   => '关闭',
        1   => '启用'
    ];

    public $typeValue = [
        0   => '响应式',
        1   => 'PC',
        2   => '移动'
    ];

    protected $fillable = [
        'id','name', 'label','type', 'images', 'status', 'created_op', 'remark'
    ];

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * 返回完整的图片地址
     *
     * @return mixed|string
     */
    public function getAvatar(){

        if ( ! starts_with($this->images, 'http')) {
            // 拼接完整的 URL
            $this->images = storage_image_url($this->images);
        }

        return $this->images;
    }

}
