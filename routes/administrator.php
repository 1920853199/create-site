<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

/*
|--------------------------------------------------------------------------
| Administrator Routes
|--------------------------------------------------------------------------
|
| 管理后台相关路由定义
|
*/

/*
 * -------------------------------------------------------------------------
 * 后台不需要需要认证相关路由
 * -------------------------------------------------------------------------
 */
Route::group(['domain' => config('administrator.domain'), 'prefix' => config('administrator.uri'), 'namespace' => 'Administrator', 'middleware' => [], ], function () {


});

/*
 * -------------------------------------------------------------------------
 * 后台需要认证相关路由
 * -------------------------------------------------------------------------
 */
Route::group(['domain' => config('administrator.domain'), 'prefix' => config('administrator.uri'), 'namespace' => 'Administrator', 'middleware' => ['laracms.auth'], ], function () {

    # 后端示例路由
    Route::get('example', 'ExampleController@index')->name('administrator.example');

    # 网站管理相关路由
    Route::get('group/index','SiteGroupController@index')->name('administrator.group.index');
    Route::get('group/create','SiteGroupController@create')->name('administrator.group.create');
    Route::post('group/save','SiteGroupController@save')->name('administrator.group.save');
    Route::get('group/edit','SiteGroupController@edit')->name('administrator.group.edit');
    Route::PATCH('group/update','SiteGroupController@update')->name('administrator.group.update');
    Route::delete('group/delete','SiteGroupController@delete')->name('administrator.group.delete');
    Route::post('group/setStatus','SiteGroupController@setStatus')->name('administrator.group.setStatus');
    // 模板管理
    Route::post('template/preview','TemplateController@preview')->name('template.preview');
    Route::post('template/setStatus','TemplateController@setStatus')->name('template.setStatus');
    Route::post('template/use','TemplateController@use')->name('template.use');
    Route::get('template/show','TemplateController@show')->name('template.show');
    Route::resource('template', 'TemplateController', ['only' => ['index', 'create','store', 'edit', 'update', 'destroy']]);
    // 商品属性管理
    Route::post('getAttr', 'GoodsTypeController@getAttr')->name('attr.getAttr');
    Route::delete('attr/clear', 'GoodsTypeController@clear')->name('attr.clear');
    Route::delete('attr/delete', 'GoodsTypeController@delete')->name('attr.delete');
    Route::resource('attr', 'GoodsTypeController', ['only' => ['index', 'create','store', 'edit', 'update', 'destroy']]);

    Route::post('format', 'GoodsTypeController@format')->name('attr.format');;
    Route::resource('goods', 'GoodsController', ['only' => ['index', 'create','store', 'edit', 'update', 'destroy']]);


});
