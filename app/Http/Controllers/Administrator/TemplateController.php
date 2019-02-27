<?php

namespace App\Http\Controllers\Administrator;

use App\Models\SiteGroup;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function __construct()
    {
        static::$activeNavId = 'group.template';
    }

    /**
     * 模板列表
     * @param Template $template
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed|\think\response\Redirect
     */
    public function index(Template $template){
        static::$activeNavId = 'group.template';

        $templates = $template->orderBy('id','desc')->recent()->paginate(config('administrator.paginate.limit'));

        // 修正页码
        if( $templates->count() < 1 && $templates->lastPage() > 1 ){
            return redirect($templates->url($templates->lastPage()));
        }

        return laravel_backend_view('template.index',compact('templates'));
    }

    /**
     * 可选择模板
     * @param Template $template
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed|\think\response\Redirect
     */
    public function show(Template $template,Request $request){
        $templates = $template->where(['status'=>'1'])->orderBy('id','desc')->recent()->paginate(config('administrator.paginate.limit'));
        // 修正页码
        if( $templates->count() < 1 && $templates->lastPage() > 1 ){
            return redirect($templates->url($templates->lastPage()));
        }

        return laravel_backend_view('template.template',compact('templates'),compact('request'));
    }


    /**
     * 创建数据
     * @param Template $templates
     * @return mixed
     */
    public function create(Template $templates){
        return laravel_backend_view('template.create_and_edit',compact('templates'));
    }

    /**
     * 修改数据
     * @param Template $templates
     * @return mixed
     */
    public function edit($id){
        $templates = Template::find($id);
        return laravel_backend_view('template.create_and_edit',compact('templates'));
    }

    /**
     * 新增保存数据
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        Template::create($request->all());
        return $this->redirect('template.index')->with('success', '添加成功.');

    }

    /**
     * 修改保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id,Request $request){
        $templates = Template::find($id);
        $templates->update($request->all());
        return $this->redirect('template.index')->with('success', '修改成功.');
    }

    /**
     * 删除
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){
        $templates = Template::find($id);
        $templates->delete();
        if(!$templates->trashed()){
            return $this->redirect()->with('success', '删除失败.');
        }
        return $this->redirect()->with('success', '删除成功.');
    }

    /**
     * 模板状态
     * @param Request $request
     * @param Template $templates
     * @return \Illuminate\Http\JsonResponse
     */
    public function setStatus(Request $request){

        $templates = Template::find($request->id);
        $templates->status = $request->status;
        $res = $templates->save();
        if(!$res){
            return response()->json([
                'code' => '500',
                'msg' => '模板'.$templates->statusValue[$templates->status].'失败.',
                'data' => $templates->statusValue[$templates->status]
            ]);
        }

        return response()->json([
            'code' => '200',
            'msg' => '模板'.$templates->statusValue[$templates->status].'成功.',
            'data' => $templates->statusValue[$templates->status]
        ]);
    }


    /**
     * 切换站点模板
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function use(Request $request){

        // 同时设置
        if($request->type == 0) {
            $data = [
                'THEME_DESKTOP' => $request->name,
                'THEME_MOBILE' => $request->name
            ];
        }

        // PC
        if($request->type == 1) {
            $data = [
                'THEME_DESKTOP' => $request->name,
                //'THEME_MOBILE' => $request->name
            ];
        }

        // 移动
        if($request->type == 2) {
            $data = [
                //'THEME_DESKTOP' => $request->name,
                'THEME_MOBILE' => $request->name
            ];
        }


        if(intval($request->site) < 1){
            return response()->json([
                'code' => '200',
                'msg' => '请先选择站点.',
                'data' => ''
            ]);
        }
        $group = SiteGroup::find($request->site);
        // 获取文件名
        $file = (parse_url($group->domain))['host'];
        // 修改配置
        modifyEnv($file,$data);

        return response()->json([
            'code' => '200',
            'msg' => '模板切换成功.',
            'data' => ''
        ]);
    }


    /**
     * 预览
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function preview(Request $request){

        if(intval($request->site) < 1){
            return response()->json([
                'code' => '500',
                'msg' => '请先选择站点.',
                'data' => ''
            ]);
        }

        $group = SiteGroup::find($request->site);

        // 取得数据库名称
        $host = (parse_url($group->domain))['host'];
        $dataname = strtr($host,'.','_');

        $data = [
            'THEME_DESKTOP' => $request->name,
            'THEME_MOBILE' => $request->name,
            'APP_URL'   =>  'http://preview.jebook.cn',
            'APP_NAME'  => $group->site_name,
            'DB_DATABASE' => $dataname,
        ];

        // 修改配置
        modifyEnv('preview.jebook.cn',$data);

        return response()->json([
            'code' => '200',
            'msg' => '正在调转...',
            'data' => 'http://preview.jebook.cn'
        ]);
    }
}
