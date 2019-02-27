<?php

namespace App\Providers;

use App\Models\Goods;
use App\Models\GoodsAttr;
use App\Models\GoodsAttrInfo;
use App\Models\GoodsAttrValue;
use App\Models\GoodsCategory;
use App\Models\GoodsDetail;
use App\Models\GoodsImage;
use App\Models\GoodsType;
use App\Models\SiteGroup;
use App\Models\Template;
use App\Observers\GoodsCategoryObserver;
use App\Observers\GoodsDetailObserver;
use App\Observers\GoodsImageObserver;
use App\Observers\GoodsObserver;
use App\Observers\SiteGroupObserver;
use App\Observers\TemplateObserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 注册模型观察者
        SiteGroup::observe(SiteGroupObserver::class);
        Template::observe(TemplateObserver::class);
        GoodsType::observe(GoodsTypeObserver::class);
        GoodsAttrValue::observe(GoodsAttrValueObserver::class);
        GoodsAttr::observe(GoodsAttrObserver::class);
        GoodsAttrInfo::observe(GoodsAttrInfoObserver::class);

        Goods::observe(GoodsObserver::class);
        GoodsCategory::observe(GoodsCategoryObserver::class);
        GoodsImage::observe(GoodsImageObserver::class);
        GoodsDetail::observe(GoodsDetailObserver::class);

        // mysql 日志
        DB::listen(function ($query) {
            Log::channel('mysql')->info('SQL:'.$query->sql.' Param:'.serialize($query->bindings).' Time:'.$query->time.'ms');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
