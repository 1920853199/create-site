<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests\Administrator\SiteGroupRequest;
use App\Models\SiteGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SiteGroupController extends Controller
{
    public function __construct()
    {
        static::$activeNavId = 'group.site';
    }

    /**
     * 站点列表
     * @param SiteGroup $groups
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed|\think\response\Redirect
     */
    public function index(SiteGroup $groups){
        static::$activeNavId = 'group.site';

        $groups = $groups->orderBy('id','desc')->recent()->paginate(config('administrator.paginate.limit'));

        // 修正页码
        if( $groups->count() < 1 && $groups->lastPage() > 1 ){
            return redirect($groups->url($groups->lastPage()));
        }

        return laravel_backend_view('group.index',compact('groups'));
    }

    /**
     * 创建数据
     * @param SiteGroup $groups
     * @return mixed
     */
    public function create(SiteGroup $groups){
        return laravel_backend_view('group.create_and_edit',compact('groups'));
    }

    /**
     * 修改数据
     * @param Request $request
     * @param SiteGroup $groups
     * @return mixed
     */
    public function edit(Request $request,SiteGroup $groups){
        $groups = $groups->find($request->id);
        return laravel_backend_view('group.create_and_edit',compact('groups'));
    }


    /**
     * 新增保存数据
     * @param Request $request
     * @param SiteGroup $groups
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(SiteGroupRequest $request,SiteGroup $group){
        // 是否存在相同域名
        $bool = $group->isExists($request->domain);

        if(!$bool){
            return $this->redirect('administrator.group.index')->with('success', '域名已存在.');
        }
        SiteGroup::create($request->all());
        return $this->redirect('administrator.group.index')->with('success', '添加成功.');

    }

    /**
     * 修改保存
     * @param Request $request
     * @param SiteGroup $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SiteGroupRequest $request){
        $group = SiteGroup::find($request->id);
        // 是否存在相同域名
        $bool = $group->isExists($request->domain,$request->id);
        if(!$bool){
            return $this->redirect('administrator.group.index')->with('success', '域名已存在.');
        }
        $group->update($request->all());
        return $this->redirect('administrator.group.index')->with('success', '修改成功.');
    }


    /**
     * 删除
     * @param Request $request
     * @param SiteGroup $group
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Request $request){
        $group = SiteGroup::find($request->id);
        $group->delete();
        if(!$group->trashed()){
            return $this->redirect()->with('success', '删除失败.');
        }
        return $this->redirect()->with('success', '删除成功.');
    }


    /**
     * 站点状态
     * @param Request $request
     * @param SiteGroup $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setStatus(Request $request,SiteGroup $group){

        // 开启事务
        DB::beginTransaction();
        $group = SiteGroup::find($request->id);
        $group->status = $request->status;
        $res = $group->save();
        if(!$res){
            return response()->json([
                'code' => '500',
                'msg' => '站点'.$group->statusValue[$group->status].'失败.',
                'data' => $group->statusValue[$group->status]
            ]);
        }


        if($group->status == 1) {
            // 创建配置文件
            $bool = create_site($group);
            if($bool !== false){
                // 创建数据库
                DB::statement("CREATE DATABASE {$bool}");
                // 导入初始化数据

                $str = <<<EOF
DBNAME="{$bool}"
create_db_sql="source /home/wwwroot/cms/cms/database/init/database.sql"
mysql -uroot -p2014gaokao -D \${DBNAME} -e "\${create_db_sql}"
EOF;

                $configPath = 'sh/sourcesql.sh';
                // 导入命令写入脚本
                Storage::disk('config')->put($configPath,$str);
                // 执行命令
                exec('/home/wwwroot/cms/cms/sh/sourcesql.sh',$argv,$argc);

                if($argc != 0){
                    Log::error(serialize($argv));
                    return response()->json([
                        'code' => '100500',
                        'msg' => '初始化失败，请联系管理员.',
                        'data' => ''
                    ]);
                    DB::rollBack();
                }
            }
        }

        DB::commit();

        return response()->json([
            'code' => '200',
            'msg' => '站点'.$group->statusValue[$group->status].'成功.',
            'data' => $group->statusValue[$group->status]
        ]);
    }
}
