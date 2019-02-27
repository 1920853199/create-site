<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_attrs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("属性名称");
            $table->integer('sort')->default(999)->comment("排序");
            $table->enum("is_upload_image",[0,1])->default(0)->comment('是否有图片');
            $table->integer('type_id')->comment("商品类型ID");
            $table->timestamps();
            $table->softDeletes();
            $table->index('name','name_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_attrs');
    }
}
