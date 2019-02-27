<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("模板名称");
            $table->string('label')->comment("模板标签");
            $table->enum("type",[0,1,2])->comment('模板类型，0响应，1PC,2移动');
            $table->string('images')->default('')->comment("模板显示图片");
            $table->enum("status",[0,1])->default(0)->comment('状态');
            $table->integer("created_op")->default(0)->comment("创建人");
            $table->string("remark")->default('')->comment("备注");
            $table->timestamps();
            $table->softDeletes();

            $table->index('name','name_index');
            $table->index('label','label_index');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
}
