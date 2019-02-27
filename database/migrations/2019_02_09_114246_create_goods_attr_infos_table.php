<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttrInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_attr_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id')->comment("商品ID");
            $table->string('attr_value_id')->comment("属性值id连起来");
            $table->decimal('price',11,2)->comment("属性售价");
            $table->decimal('original_price',11,2)->comment("属性原价");
            $table->integer('stock')->comment("库存");
            $table->string('sku')->comment("属性SKU");
            $table->timestamps();
            $table->softDeletes();
            $table->index('sku','sku_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_attr_infos');
    }
}
