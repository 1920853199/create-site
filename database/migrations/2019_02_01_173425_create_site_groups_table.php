<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name')->comment("站点名称");
            $table->string('domain')->comment("域名");
            $table->string('template')->default('')->comment("PC模板名称");
            $table->string('template_mobile')->default('')->comment("移动模板名称");
            $table->string('director')->comment("负责人");
            $table->string('phone')->comment("手机");
            $table->string('email')->comment("邮箱");
            $table->enum("status",[0,1])->default(0)->comment('状态');
            $table->integer("created_op")->default(0)->comment("创建人");

            $table->timestamps();
            $table->softDeletes();

            $table->index('site_name','site_name_index');
            $table->index('domain','domain_index');
            $table->index('director','director_index');
            $table->index('phone','phone_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_groups');
    }
}
