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

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if( !function_exists("laravel_frontend_view") ){
    /**
     * 前台 view 加载函数
     *
     * @author lele.wang <lele.wang@raiing.com>
     * @param $name
     * @return mixed
     */
    function laravel_frontend_view($name)
    {
        // 注册模板变量
        $themeType = is_mobile() ? 'mobile' : 'desktop';
        $theme = is_mobile() ? config('theme.mobile') :  config('theme.desktop');
        $args = func_get_args();
        $args[0] = $theme .'.'.$themeType.'.'.$name;
        return view(...$args);
    }

    /**
     * 后台 view 加载函数
     * @param $name
     * @return mixed
     */
    function laravel_backend_view($name)
    {
        $args = func_get_args();
        $args[0] = 'backend.'.$name;

        return view(...$args);
    }
}

if( !function_exists("create_site") ){

    function create_site(\App\Models\Model $model){

        // 取得数据库名称
        $host = (parse_url($model->domain))['host'];
        $dataname = strtr($host,'.','_');
        // 配置存放路径
        $configPath = 'install/.env.'.$host;

        // 存在配置返回false
        if(Storage::disk('config')->exists($configPath)){
            return false;
        }
        // 配置文件
        $str =
<<<EOF
APP_NAME={$model->site_name}
APP_ENV=production
APP_KEY=base64:qumswBZuK5E7nJPR7xaaGoYCnIV42VAjfYryViFYIZU=
APP_DEBUG=false
APP_URL={$model->domain}

THEME_DESKTOP=cms
THEME_MOBILE=cms

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={$dataname}
DB_USERNAME=root
DB_PASSWORD=2014gaokao
DB_PREFIX=lara_

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="\${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="\${PUSHER_APP_CLUSTER}"

FILESYSTEM_DRIVER=public

ALIYUN_ACCESS_KEY_ID=
ALIYUN_ACCESS_KEY_SECRET=
ALIYUN_OSS_BUCKET=
ALIYUN_OSS_ENDPOINT=
ALIYUN_OSS_PREFIX=
ALIYUN_OSS_URL=
ALIYUN_VOD_REGION_ID=
ALIYUN_VOD_URLOAD_URL=

AZURE_STORAGE_NAME=
AZURE_STORAGE_KEY=
AZURE_STORAGE_CONTAINER=

BAIDU_TRANSLATE_APPID=
BAIDU_TRANSLATE_KEY=

API_STANDARDS_TREE=prs
API_SUBTYPE=laracms
API_DOMAIN=
API_PREFIX=api
API_VERSION=v1
API_DEBUG=true

WEIXIN_KEY=
WEIXIN_SECRET=
WEIXIN_REDIRECT_URI="\${APP_URL}/login/weixin/callback"

WEIXINWEB_KEY=
WEIXINWEB_SECRET=
WEIXINWEB_REDIRECT_URI=

QQ_KEY=
QQ_SECRET=
QQ_REDIRECT_URI="\${APP_URL}/login/qq/callback"

WEIBO_KEY=
WEIBO_SECRET=
WEIBO_REDIRECT_URI="\${APP_URL}/login/weibo/callback"

GITHUB_KEY=
GITHUB_SECRET=
GITHUB_REDIRECT_URI="\${APP_URL}/login/github/callback"

JWT_SECRET=HSKxIUfwCdJj5gadbqfQo5im9zje95g9


SCOUT_DRIVER=tntsearch

EOF;
        // 创建配置文件
        Storage::disk('config')->put($configPath,$str);
        return $dataname;

    }


    /**
     * 动态修改配置信息
     * @param array $data
     */
    function modifyEnv($file,array $data)
    {
        // 获取配置路径
        $envPath = base_path() . '/install/.env.' . $file;
        $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
        $contentArray->transform(function ($item) use ($data){
            foreach ($data as $key => $value){
                if(str_contains($item, $key)){
                    return $key . '=' . $value;
                }
            }
            return $item;
        });

        $content = implode($contentArray->toArray(), "\n");

        \File::put($envPath, $content);
    }
}


function getStrTime(){
    $no = date("H",time());
    if ($no > 0 && $no <= 6){
        return "凌晨好";
    }
    if ($no > 6&& $no < 12){
        return "上午好";
    }
    if ($no >= 12 && $no <= 18){
        return "下午好";
    }
    if ($no > 18 && $no <= 24){
        return "晚上好";
    }
    return "您好";
}

function createGoodsSku($goods_id,$goods_attr_info_id = ''){
    return 'SKU'.$goods_id.$goods_attr_info_id;
}
function createGoodsID($type_id){
    return '0'.date('Ymd').sprintf("%03d", $type_id).'';
}
