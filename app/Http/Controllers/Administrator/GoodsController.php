<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Goods;
use App\Models\GoodsType;
use Illuminate\Http\Request;
use Wanglelecc\Laracms\Handlers\CategoryHandler;

class GoodsController extends Controller
{
    public function __construct()
    {
        static::$activeNavId = 'goods.goods';
    }



    public function index(Goods $goods){

        static::$activeNavId = 'goods.goods';

        $goods = $goods->orderBy('id','desc')->recent()->paginate(config('administrator.paginate.limit'));

        //修正页码
        if( $goods->count() < 1 && $goods->lastPage() > 1 ){
            return redirect($goods->url($goods->lastPage()));
        }

        return laravel_backend_view('goods.index',compact('goods'));

    }


    public function create(Goods $goods,CategoryHandler $categoryHandler){

        $type = GoodsType::get();
        $category = $categoryHandler->web($categoryHandler->select($categoryHandler->getCategorys('goods')), []);
        return laravel_backend_view('goods.create_and_edit',compact('goods','category','type'));
    }

    /**
     * 新增保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        return $this->redirect('goods.index')->with('success', '添加成功.');
    }


    /**
     * 编辑
     * @param $id
     * @return mixed
     */
    public function edit($id){
        return laravel_backend_view('goods.create_and_edit',compact('goods'));
    }


    /**
     * 更新数据
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id,Request $request){
        return $this->redirect()->with('success', '修改成功.');

    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){
        return $this->redirect()->with('success', '删除成功.');
    }

}
