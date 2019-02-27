<?php

namespace App\Http\Controllers\Administrator;

use App\Models\GoodsAttr;
use App\Models\GoodsAttrValue;
use App\Models\GoodsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoodsTypeController extends Controller
{
    public function __construct()
    {
        static::$activeNavId = 'goods.attr';
    }


    /**
     * 商品类型列表
     * @param GoodsType $goodsTypes
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed|\think\response\Redirect
     */
    public function index(GoodsType $goodsTypes){

        static::$activeNavId = 'goods.attr';

        $goodsTypes = $goodsTypes->orderBy('id','desc')->recent()->paginate(config('administrator.paginate.limit'));

        //修正页码
        if( $goodsTypes->count() < 1 && $goodsTypes->lastPage() > 1 ){
            return redirect($goodsTypes->url($goodsTypes->lastPage()));
        }

        return laravel_backend_view('attr.index',compact('goodsTypes'));

    }

    /**
     * 创建
     * @param GoodsType $goodsType
     * @return mixed
     */
    public function create(GoodsType $goodsType){
        return laravel_backend_view('attr.create_and_edit',compact('goodsType'));
    }

    /**
     * 新增保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        // 数据处理
        // 开启事务
        DB::beginTransaction();
        // Type 数据
        $goodsType = GoodsType::create(['name'=>$request->name]);
        // Goods_Attr数据
        $attr = [];
        //'id','name','sort','is_upload_image','type_id'
        foreach ($request->attr_name as $k => $v){
            $attr['name'] = $v;
            $attr['sort'] = $request->attr_sort[$k];
            $attr['is_upload_image'] = '0';
            $attr['type_id'] = $goodsType->id;

            $goodsAttr = GoodsAttr::create($attr);
            if(!$goodsAttr){
                DB::rollBack();
                return $this->redirect('attr.index')->with('success', '添加失败.');
            }

            $attr_value = str_replace('，',',',$request->attr_value[$k]);
            $attrValue = explode(",",$attr_value);
            $attrValueArr = [];
            foreach ($attrValue as $key => $value){
                //'id','attr_id','attr_value'
                $attrValueArr['attr_id'] = $goodsAttr->id;
                $attrValueArr['attr_value'] = $value;
                $attrValueArr['attr_image'] = '';
                $goodsAttrValue = GoodsAttrValue::create($attrValueArr);
                if(!$goodsAttrValue){
                    DB::rollBack();
                    return $this->redirect('attr.index')->with('success', '添加失败.');
                }
            }


        }
        DB::commit();

        return $this->redirect('attr.index')->with('success', '添加成功.');
    }


    /**
     * 编辑
     * @param $id
     * @return mixed
     */
    public function edit($id){

        // 获取数据
        $typeModel = new GoodsType();
        $res = $typeModel->getAttrAndValues($id);

        $type = $typeModel->find($id);
        $arr = [];
        foreach ($res as $k => $v) {
            $arr[$v->attr_id]['attr_value'][] = $v->attr_value;
            $arr[$v->attr_id]['name'] = $v->name;
            $arr[$v->attr_id]['is_upload_image'] = $v->is_upload_image;
            $arr[$v->attr_id]['sort'] = $v->sort;
        }

        $goodsType['type']['id'] = $type->id;
        $goodsType['type']['name'] = $type->name;
        $goodsType['attr'] = $arr;

        return laravel_backend_view('attr.create_and_edit',compact('goodsType'));
    }


    /**
     * 更新数据
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id,Request $request){

        // 开启事务
        DB::beginTransaction();
        $goodsType = GoodsType::find($id);
        $goodsType->name = $request->name;

        if(!$goodsType->save()){
            DB::rollBack();
            return $this->redirect()->with('success', '修改失败.');
        }

        if(!empty($request->attr_id)) {
            // 删除所有的属性
            $goodsAttr = new GoodsAttr();
            $res = $goodsAttr->deleteValue($id);
            if ($res === false) {
                DB::rollBack();
                return $this->redirect()->with('success', '修改失败.');
            }
            // 删除所有的值
            $goodsAttrValue = new GoodsAttrValue();
            foreach ($request->attr_id as $v) {
                $res = $goodsAttrValue->deleteValue($v);
                if ($res === false) {
                    DB::rollBack();
                    return $this->redirect()->with('success', '修改失败.');
                }
            }
        }

        // 插入数据
        foreach ($request->attr_name as $k => $v){
            $attr['name'] = $v;
            $attr['sort'] = $request->attr_sort[$k];
            $attr['is_upload_image'] = '0';
            $attr['type_id'] = $id;

            $goodsAttr = GoodsAttr::create($attr);
            if(!$goodsAttr){
                DB::rollBack();
                return $this->redirect()->with('success', '修改失败.');
            }

            $attr_value = str_replace('，',',',$request->attr_value[$k]);
            $attrValue = explode(",",$attr_value);
            $attrValueArr = [];
            foreach ($attrValue as $key => $value){
                //'id','attr_id','attr_value'
                $attrValueArr['attr_id'] = $goodsAttr->id;
                $attrValueArr['attr_value'] = $value;
                $attrValueArr['attr_image'] = '';
                $goodsAttrValue = GoodsAttrValue::create($attrValueArr);
                if(!$goodsAttrValue){
                    DB::rollBack();
                    return $this->redirect()->with('success', '修改失败.');
                }
            }

        }


        DB::commit();

        return $this->redirect()->with('success', '修改成功.');

    }


    /**
     * 删除类型
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){
        $goodsType = GoodsType::find($id);
        DB::beginTransaction();
        $goodsType->delete();
        if(!$goodsType->trashed()){
            DB::rollBack();
            return $this->redirect()->with('success', '删除失败.');
        }

        $res = GoodsAttr::where('type_id','=',$id)->get()->toArray();
        if($res){
            $goodsAttrValue = new GoodsAttrValue();
            foreach ($res as $k => $v){
                $bool = $goodsAttrValue->deleteValue($v['id']);
                if($bool === false){
                    DB::rollBack();
                    return $this->redirect()->with('success', '删除失败.');
                }
            }

            $goodsAttr = new GoodsAttr();
            $bool = $goodsAttr->deleteValue($id);
            if($bool === false){
                DB::rollBack();
                return $this->redirect()->with('success', '删除失败.');
            }
        }
        DB::commit();
        return $this->redirect()->with('success', '删除成功.');
    }


    /**
     * 删除属性以及值
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request){
        $attr_id = $request->attr_id;

        $goodsAttr = GoodsAttr::find($attr_id);
        // 开启事务
        DB::beginTransaction();
        $goodsAttr->delete();
        if(!$goodsAttr->trashed()){
            DB::rollBack();
            return $this->redirect()->with('success', '删除失败.');
        }
        $goodsAttrValue = new GoodsAttrValue();
        $res = $goodsAttrValue->deleteValue($attr_id);
        if($res === false){
            DB::rollBack();
            return $this->redirect()->with('success', '删除失败.');
        }

        DB::commit();
        return $this->redirect()->with('success', '删除成功.');
    }


    /**
     * 清除数据
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear(){

        $sum = 0;
        $goodsType = new GoodsType();
        $sum += $goodsType->onlyTrashed()->count();
        $goodsType->onlyTrashed()->forceDelete();

        $goodsAttr = new GoodsAttr();
        $sum += $goodsAttr->onlyTrashed()->count();
        $goodsAttr->onlyTrashed()->forceDelete();

        $goodsAttrValue = new GoodsAttrValue();
        $sum += $goodsAttrValue->onlyTrashed()->count();
        $goodsAttrValue->onlyTrashed()->forceDelete();

        return $this->redirect()->with('success', '成功清空 '.$sum.' 条数据.');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAttr(Request $request){
        if(intval($request->type_id)<0){
            return response()->json([
                'code' => '500',
                'msg' => '请选择类型.',
                'data' => ''
            ]);
        }

        // 获取数据
        $typeModel = new GoodsType();
        $res = $typeModel->getAttrAndValues($request->type_id);

        $arr = [];
        foreach ($res as $k => $v) {
            $arr[$v->attr_id]['attr_value'][$v->value_id] = $v->attr_value;
            $arr[$v->attr_id]['name'] = $v->name;
            $arr[$v->attr_id]['is_upload_image'] = $v->is_upload_image;
            $arr[$v->attr_id]['sort'] = $v->sort;
        }

        return response()->json([
            'code' => '200',
            'msg' => 'success.',
            'data' => $arr,
            'length' => count($arr)
        ]);
    }


    public function format(Request $request){

        $attr = $request->attr_value;
        $attr_id = [];
        $value_id = [];
        foreach ($attr as $k => $v){
            $ids = explode('_',$v);//属性ID_属性值ID
            if(!in_array($ids[0],$attr_id)) {
                $attr_id[] = $ids[0];
            }
            if(!in_array($ids[1],$value_id)) {
                $value_id[$ids[0]][] = $ids[1];
            }
        }

        echo '<pre>';
        var_dump($attr_id);
        var_dump($value_id);die;

        // 属性
        $attr = GoodsAttr::find($attr_id)->toArray();
        // 属性值
        $value = GoodsAttrValue::find($value_id)->toArray();

        echo '<pre>';
        var_dump($attr);
        var_dump($value);die;


        if(intval($ids[0]) < 0 || intval($ids[1]) < 0){
            return response()->json([
                'code' => '500',
                'msg' => 'Error.',
                'data' => ''
            ]);
        }

        GoodsType::find();


    }
}
