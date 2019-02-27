@extends('backend::layouts.app')

@section('title', $title = $goods->id ? '编辑商品' : '添加商品' )

@section('breadcrumb')
    <li><a href="javascript:;">商品管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
    @php
        $object_id = $goods->object_id ?? create_object_id();
    @endphp


    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">

                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $goods->id ? route('goods.update', $goods->id) : route('goods.store') }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method"  value="{{ $goods->id ? 'PATCH' : 'POST' }}">
                        <input type="hidden" name="type" value="{{--{{ $type }}--}}">

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-tab href="#tabContent1">基本信息</a></li>
                            <li><a data-tab href="#tabContent2">商品相册</a></li>
                            <li><a data-tab href="#tabContent3">商品属性</a></li>
                        </ul>
                        <div class="tab-content" style="padding: 50px 0px">
                            <div class="tab-pane active" id="tabContent1">
                                <div class="form-group has-feedback  has-icon-right">
                                    <label for="type" class="col-md-2 col-sm-2 control-label required">所属分类</label>
                                    <div class="col-md-5 col-sm-10">
                                    <select name="category_id[]" class="chosen-select form-control" id="category_id[]" tabindex="2" multiple="">
                                        @foreach($category as $value)
                                            <option @if($value['check']) selected @endif value="{{$value['id']}}">/ {{$value['name']}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group has-feedback  has-icon-right">
                                    <label for="name" class="col-md-2 col-sm-2 control-label required">商品名称</label>
                                    <div class="col-md-5 col-sm-10">
                                    <input type="text" name="name" required autocomplete="off" class="form-control" value="{{ old('name',$goods->name) }}" >
                                    </div>
                                </div>

                                <div class="form-group has-feedback  has-icon-right">
                                    <label for="keywords" class="col-md-2 col-sm-2 control-label">关键词</label>
                                    <div class="col-md-5 col-sm-10">
                                    <input type="text" name="keyword" autocomplete="off" class="form-control" value="{{ old('keyword',$goods->keyword) }}" >
                                    </div>
                                </div>

                                <div class="form-group has-feedback  has-icon-right">
                                    <label for="describe" class="col-md-2 col-sm-2 control-label">描述</label>
                                    <div class="col-md-5 col-sm-10">
                                    <textarea name="describe" class="form-control" rows="4">{{  old('describe', $goods->describe) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group has-feedback  has-icon-right">
                                    <label for="subtitle" class="col-md-2 col-sm-2 control-label">简介</label>
                                    <div class="col-md-5 col-sm-10">
                                        <textarea name="summary" class="form-control" rows="4">{{  old('summary', $goods->summary) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group has-feedback  has-icon-right">
                                    <label for="content" class="col-md-2 col-sm-2 control-label required">内容</label>
                                    <div class="col-md-8 col-sm-10">
                                    <textarea name="content" id="content" class="form-control editor" >{{  old('content', $goods->content) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group has-feedback  has-icon-right">
                                        <label class="col-md-2 col-sm-2 control-label">产品主图</label>
                                        <div class="col-md-8 col-sm-10">
                                        <div class="panel">
                                            <div class="panel-body">
                                                <img src="{{ storage_image_url($goods->image) }}" id="image_image" class="img-rounded" width="660px" height="300px" alt="">
                                                <input type="hidden" name="imgae" id="form_thumb" value="{{ old('image',$goods->image) }}" />
                                                <button id="upload_thumb" type="button" class="btn btn-info uploader-btn-browse"><i class="icon icon-upload"></i> 上传</button>
                                                {{--<button id="select_thumb" type="button" class="btn btn-primary"><i class="icon icon-file-image"></i> 选择</button>--}}
                                                <button id="delete_thumb" type="button" class="btn btn-danger"><i class="icon icon-remove-sign"></i> 删除</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--@if($type)
                                    @includeIf('backend::article.template.'.$type,['article' => $goods])
                                @endif--}}
                                <div class="form-group has-feedback has-icon-right">
                                    <label class="col-md-2 col-sm-2 control-label required">库存</label>
                                    <div class="col-md-5 col-sm-10">
                                        <input type="number" name="stock" autocomplete="off" class="form-control" value="{{ old('stock',$goods->stock) }}"
                                               required
                                               data-fv-trigger="blur"
                                               min="1"
                                               max="9999"
                                        ></div>
                                </div>

                                <div class="form-group has-feedback has-icon-right">
                                    <label class="col-md-2 col-sm-2 control-label required">虚拟销量</label>
                                    <div class="col-md-5 col-sm-10">
                                        <input type="number" name="sales" autocomplete="off" class="form-control" value="{{ old('stock',$goods->stock) }}"
                                               required
                                               data-fv-trigger="blur"
                                               min="1"
                                               max="9999999"
                                        >
                                        <div class="help-block">虚拟销售量（请输入0~9999999）：虚拟销售量 + 真实销量</div>
                                    </div>
                                </div>

                                <div class="form-group has-feedback has-icon-right">
                                    <label class="col-md-2 col-sm-2 control-label required">排序</label>
                                    <div class="col-md-5 col-sm-10">
                                    <input type="number" name="sort" autocomplete="off" class="form-control" value="{{ old('sort',$goods->sort) }}"
                                           required
                                           data-fv-trigger="blur"
                                           min="1"
                                           max="9999"
                                    ></div>
                                </div>

                                <div class="form-group has-feedback has-icon-right">
                                    <label for="" class="col-md-2 col-sm-2 control-label required">是否热销</label>
                                    <div class="col-md-5 col-sm-10">
                                        <div class="switch">
                                            <input @if($goods->is_hot == 1) checked @endif name="is_hot" type="checkbox">
                                            <label>&nbsp;</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group has-feedback has-icon-right">
                                    <label for="" class="col-md-2 col-sm-2 control-label required">是否新品</label>
                                    <div class="col-md-5 col-sm-10">
                                        <div class="switch">
                                            <input @if($goods->is_new !== 0) checked @endif name="is_new" type="checkbox">
                                            <label>&nbsp;</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group has-feedback has-icon-right">
                                    <label for="" class="col-md-2 col-sm-2 control-label required">是否推荐</label>
                                    <div class="col-md-5 col-sm-10">
                                        <div class="switch">
                                            <input @if($goods->is_recommend == 1) checked @endif name="is_recommend" type="checkbox">
                                            <label>&nbsp;</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group has-feedback has-icon-right">
                                    <label for="" class="col-md-2 col-sm-2 control-label required">是否上架</label>
                                    <div class="col-md-5 col-sm-10">
                                        <div class="switch">
                                            <input @if($goods->is_on_sale == 1) checked @endif name="is_on_sale" type="checkbox">
                                            <label>&nbsp;</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabContent2">
                                <div>
                                    <div id="more_image" style="margin-bottom: 20px">
                                    </div>
                                    {{--<img src="{{ storage_image_url($goods->image) }}" class="image_url" width="220px" height="100px" alt="">
                                    <input type="hidden" name="image_url" id="form_thumb" value="{{ old('image_url',$goods->image_url) }}" />
                                    --}}
                                    <button id="upload_image_url" type="button" class="btn btn-info uploader-btn-browse"><i class="icon icon-upload"></i> 上传</button>
                                    {{--<button id="select_thumb" type="button" class="btn btn-primary"><i class="icon icon-file-image"></i> 选择</button>--}}
                                    <div style="clear: both"></div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabContent3">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td>商品类型</td>
                                        <td class="td-type" colspan="4">
                                            <select class="form-control type">
                                                <option value="">请选择商品类型</option>
                                                @foreach($type as $k => $v)
                                                <option value="{{$v->id}}">{{$v->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-attr" colspan="5">商品属性</td>
                                    </tr>
                                    </thead>
                                    <tbody class="tr_conent">
                                    {{--<tr>
                                        <td>水果</td>
                                        <td>
                                            <select data-placeholder="选择一些爱吃的水果..." class="chosen-select form-control" tabindex="2" multiple="">
                                                <option value="strawberries">草莓</option>
                                                <option value="apple">苹果</option>
                                                <option value="orange">橙子</option>
                                                <option value="cherry">樱桃</option>
                                                <option value="banana">香蕉</option>
                                                <option value="figs">无花果</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>水果</td>
                                        <td>
                                            <select data-placeholder="选择一些爱吃的水果..." class="chosen-select form-control" tabindex="2" multiple="">
                                                <option value="strawberries">草莓</option>
                                                <option value="apple">苹果</option>
                                                <option value="orange">橙子</option>
                                                <option value="cherry">樱桃</option>
                                                <option value="banana">香蕉</option>
                                                <option value="figs">无花果</option>
                                            </select>
                                        </td>
                                    </tr>--}}
                                    </tbody>
                                    <tfoot class="tr_value">
                                        <tr class="add_attr">
                                            <td>原价</td>
                                            <td>售价</td>
                                            <td>库存</td>
                                            <td>操作</td>
                                        </tr>
                                        <tr>
                                        <td>红色</td>
                                        <td>
                                            <input type="text" name="" required autocomplete="off" class="form-control" value="">
                                        </td>
                                        <td>
                                            <input type="text" name="" required autocomplete="off" class="form-control" value=""></td>
                                        <td>
                                            <input type="text" name="" required autocomplete="off" class="form-control" value=""></td>
                                        <td>
                                            <div class="switch">
                                                <input name="" type="checkbox">
                                                <label>&nbsp;</label>
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5 col-sm-10">
                                <button type="submit" class="btn btn-primary">提交</button>
                                <button type="reset" class="btn btn-default">重置</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @include('backend::common._editor_styles')
@stop

@section('scripts')

    <script>
        function del(e) {
            $(e).remove();
        }
        $('select.chosen-select').chosen({
            no_results_text: '没有找到',    // 当检索时没有找到匹配项时显示的提示文本
            disable_search_threshold: 10, // 10 个以下的选择项则不显示检索框
            search_contains: true,         // 从任意位置开始检索
            width:'100%'
        });

        function change(e){

            $.ajax({
                type:'POST',
                url:'{{route('attr.format')}}',
                data:$('#form-validator').serialize(),
                success:function () {

                }
            });

        }

        $('.type').on('change', function(){
            var type_id = $(this).val();
            $.post('{{route('attr.getAttr')}}',{
                'type_id':type_id,
            },function (data) {
                if(data.data != '') {
                    console.log(data.length);
                    $(".td-type").attr("colSpan",data.length+3);
                    $(".td-attr").attr("colSpan",data.length+4);

                    var html = '';
                    $.each(data.data, function (k, v) {
                        html += '<tr><td>' + v.name + '</td>' +
                            '<td colspan="'+(data.length+3)+'"><select name="attr_value[]" onchange="change(this)" data-placeholder="选择属性" class="chosen-select form-control attr_value" tabindex="2" multiple="">';

                        $.each(v.attr_value, function (key, value) {
                            html += '<option value="' + k+'_'+key + '">' + value + '</option>';
                        });

                        html += '</select></td></tr>';
                    });
                    $('.tr_conent').append(html);
                    $('select.chosen-select').chosen({width:'100%'});
                }else{
                    $('.tr_conent').html('');
                    new $.zui.Messager('请先添加属性以及值.', {
                    type:'success',
                    }).show();
                }
            });
        });


    </script>

    @include('backend::common._editor_scripts',[ 'folder'=>'goods', 'object_id'=>$object_id ])

    @include('backend::common._upload_image_scripts',['elem' => '#upload_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'goods', 'object_id'=>$object_id])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'goods', 'object_id'=>$object_id ])

    {{--
    elem：上传按钮节点
    previewElem：图片容器
    fieldElem：表单名称
    --}}

    @include('backend::common._upload_more_image_scripts',['elem' => '#upload_image_url', 'previewElem' => '#more_image', 'fieldElem' => 'image_url[]', 'folder'=>'goods', 'object_id'=>$object_id])

    {{--@include('backend::common._upload_aliyun_vod_scripts',['elem' => '#upload_video', 'previewElem' => '#video_title_h4', 'fieldIdElem' => '#upload_video_id', 'fieldTitleElem' => '#upload_video_title', 'fieldThumbElem' => '#upload_video_thumb', 'fieldImageElem' => '#video_thumb_image', 'folder'=>'article', 'object_id'=>$object_id])
    @include('backend::common._delete_aliyun_vod_scripts',['elem' => '#delete_video', 'previewElem' => '#video_title_h4', 'fieldIdElem' => '#upload_video_id', 'fieldTitleElem' => '#upload_video_title', 'fieldThumbElem' => '#upload_video_thumb', 'fieldImageElem' => '#video_thumb_image', 'folder'=>'article', 'object_id'=>$object_id])
--}}
@stop