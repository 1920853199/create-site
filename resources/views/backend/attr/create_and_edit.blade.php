@extends('backend::layouts.app')

@section('title', $title = $goodsType['type']['id'] ? '编辑商品类型' : '创建商品类型' )

@section('breadcrumb')
    <li><a href="">商品管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{$goodsType['type']['id'] ? route('attr.update',$goodsType['type']['id']):route('attr.store')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="{{ $goodsType['type']['id'] ? 'PATCH' : 'POST' }}">
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">类型名称</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="text" name="name" id="name" autocomplete="off" placeholder="" class="form-control" value="{{$goodsType['type']['name']}}"
                                       required
                                       data-fv-trigger="blur"
                                       minlength="1"
                                       maxlength="128"
                                >
                            </div>
                        </div>
                        <hr>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>属性名称</th>
                                <th>排序</th>
                                <th>是否可上传规格图</th>
                                <th>属性值</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody class="attr_content">
                            <tr>
                                <td colspan="5">
                                    <a href="javascript:;" class="btn btn-primary add_attr"><i class="icon icon-plus-sign"></i> 添加属性</a>
                                </td>
                            </tr>
                            @if($goodsType['type']['id'])
                                @foreach($goodsType['attr'] as $k => $v)
                                    <input type="hidden" value="{{$k}}" name="attr_id[]" />
                                    <tr>
                                        <td>
                                            <input type="text" name="attr_name[]" autocomplete="off" placeholder="" class="form-control" value="{{$v['name']}}"
                                                   required
                                                   data-fv-trigger="blur"
                                                   minlength="1"
                                                   maxlength="128"
                                            >
                                        </td>
                                        <td>
                                            <input type="text" name="attr_sort[]" autocomplete="off" placeholder="" class="form-control" value="{{$v['sort']}}"
                                                   required
                                                   data-fv-trigger="blur"
                                                   minlength="1"
                                                   maxlength="128"
                                            >
                                        </td>
                                        <td>
                                            <div class="switch">
                                                <input name="attr_is_upload_image[]" type="checkbox">
                                                <label>&nbsp;</label>
                                            </div>
                                        <td>
                                            <input type="text" name="attr_value[]" placeholder="多个值用英文,隔开" autocomplete="off" placeholder="" class="chosen-select form-control" value="<?php echo implode(',',$v['attr_value']); ?>"
                                                   required
                                                   data-fv-trigger="blur"
                                                   minlength="1"
                                                   maxlength="128"
                                            >
                                        </td>
                                        <td>
                                            <a href="javascript:;" data-url="{{ route('attr.delete', ['attr_id'=>$k]) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <input type="text" name="attr_name[]" autocomplete="off" placeholder="" class="form-control" value=""
                                               required
                                               data-fv-trigger="blur"
                                               minlength="1"
                                               maxlength="128"
                                        >
                                    </td>
                                    <td>
                                        <input type="text" name="attr_sort[]" autocomplete="off" placeholder="" class="form-control" value="999"
                                               required
                                               data-fv-trigger="blur"
                                               minlength="1"
                                               maxlength="128"
                                        >
                                    </td>
                                    <td>
                                        <div class="switch">
                                            <input name="attr_is_upload_image[]" type="checkbox">
                                            <label>&nbsp;</label>
                                        </div>
                                    <td>
                                        <input type="text" name="attr_value[]" placeholder="多个值用英文,隔开" autocomplete="off" placeholder="" class="chosen-select form-control" value=""
                                               required
                                               data-fv-trigger="blur"
                                               minlength="1"
                                               maxlength="128"
                                        >
                                    </td>
                                    <td>
                                        <a href="javascript:;" data-url="{{--{{ route('goods_attr.delete', ['id'=>$group->id]) }}--}}" class="btn btn-xs btn-danger form-delete">删除</a>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5 col-sm-10">
                                <button type="submit" class="btn btn-primary">提交</button>
                                <a href="{{route('attr.index')}}" class="btn btn-default">返回</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            // 模板使用状态
            $(".add_attr").click(function() {
                var html = '<tr>\n' +
                    '                                <td>\n' +
                    '                                    <input type="text" name="attr_name[]" autocomplete="off" placeholder="" class="form-control" value=""\n' +
                    '                                           required\n' +
                    '                                           data-fv-trigger="blur"\n' +
                    '                                           minlength="1"\n' +
                    '                                           maxlength="128"\n' +
                    '                                    >\n' +
                    '                                </td>\n' +
                    '                                <td>\n' +
                    '                                    <input type="text" name="attr_sort[]" autocomplete="off" placeholder="" class="form-control" value="999"\n' +
                    '                                           required\n' +
                    '                                           data-fv-trigger="blur"\n' +
                    '                                           minlength="1"\n' +
                    '                                           maxlength="128"\n' +
                    '                                    >\n' +
                    '                                </td>\n' +
                    '                                <td><div class="switch">\n' +
                    '                                        <input name="attr_is_upload_image[]" type="checkbox">\n' +
                    '                                        <label>&nbsp;</label>\n' +
                    '                                    </div></td>\n' +
                    '                                <td>\n' +
                    '                                    <input type="text" name="attr_value[]" placeholder="多个值用英文,隔开" autocomplete="off" placeholder="" class="chosen-select form-control" value=""\n' +
                    '                                           required\n' +
                    '                                           data-fv-trigger="blur"\n' +
                    '                                           minlength="1"\n' +
                    '                                           maxlength="128"\n' +
                    '                                    >\n' +
                    '                                </td>\n' +
                    '                                <td>\n' +
                    '                                    <a href="javascript:;" onclick="remove(this)" data-url="{{--{{ route(\'goods_attr.delete\', [\'id\'=>$group->id]) }}--}}" class="btn btn-xs btn-danger form-delete">删除</a>\n' +
                    '                                </td>\n' +
                    '                            </tr>';
                $('.attr_content').append(html);
            });
        });

        function remove(e) {
            $(e).parent().parent().remove();
        }
    </script>
@endsection