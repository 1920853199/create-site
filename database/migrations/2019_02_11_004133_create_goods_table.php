<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment("商品名称");
            $table->integer('type_id')->comment("类型ID");
            $table->string('summary')->comment("简介");
            $table->string('sku')->comment("属性SKU");
            $table->decimal('price',11,2)->comment("属性售价");
            $table->decimal('original_price',11,2)->comment("属性原价");
            $table->string('image')->comment("图片");
            $table->integer('stock')->comment("库存");
            $table->enum("is_new",[0,1])->default(1)->comment('新品');
            $table->enum("is_hot",[0,1])->default(0)->comment('热销');
            $table->enum("is_on_sale",[0,1])->default(0)->comment('是否上架');
            $table->enum("is_recommend",[0,1])->default(0)->comment('推荐');
            $table->integer("sort")->comment('排序');
            $table->integer('sales')->comment("销量");
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
        Schema::dropIfExists('goods');
    }
}
