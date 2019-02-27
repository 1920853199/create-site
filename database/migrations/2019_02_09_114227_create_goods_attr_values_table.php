<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttrValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_attr_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attr_id')->comment("属性ID");
            $table->string('attr_value')->comment("属性值");
            $table->string('attr_image')->comment("属性图片");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_attr_values');
    }
}
