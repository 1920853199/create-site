<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id')->comment("商品ID");
            $table->string('keyword',255)->comment("商品关键字");
            $table->string('describe',255)->comment("商品描述");
            $table->longText('content')->comment("商品详情");
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
        Schema::dropIfExists('goods_details');
    }
}
