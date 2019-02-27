@extends('backend::layouts.app')

@section('title', $title = '商品类型')

@section('breadcrumb')
    <li><a href="javascript:;">商品管理</a></li>
    <li>{{$title}}</li>
@endsection

@section('content')
    @php
        $keyword = request('keyword', '');
    @endphp
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                    <form class="layui-form" method="GET" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" value="{{$keyword}}" placeholder="关键字">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">搜索</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="tools-group">
                    <a href="{{ route('attr.create') }}"  class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                    <a href="javascript:;" data-url="{{ route('attr.clear')}}" class="btn btn-danger form-delete"><i class="icon icon-plus-sign"></i> 清空垃圾箱</a>
                </div>
            </div>

            @if(count($goodsTypes))
                <form name="form-article-list" id="form-category-list" class="layui-form layui-form-pane2" method="POST" {{--action="{{route('administrator.category.order', $type)}}"--}}>
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <colgroup>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">类型名称</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goodsTypes as $index => $group)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $group->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('attr.edit', ['id'=>$group->id]) }}" class="btn btn-xs btn-info btn-primary">编辑</a>
                                    <a href="javascript:;" data-url="{{ route('attr.destroy', ['id'=>$group->id]) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
                <div id="paginate-render">
                    {{$goodsTypes->links('pagination::backend')}}
                </div>
            @else
                <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection


@section('scripts')
<script>
    $(function () {
        // 模板使用状态
        $(".status").change(function() {
            var obj = $(this);
            var status = 0;
            var id = $(this).attr('data-id');
            if($(this).is(':checked')){
                status = 1;
            }
            /*headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }*/
            $.post('{{route('administrator.group.setStatus')}}',{
                'id':id,
                'status':status,
            },function (data) {
                if(data.code != 100500) {
                    obj.next().text(data.data);
                }
                new $.zui.Messager(data.msg, {
                    type:'success',
                }).show();

            });
            
        });
    });
</script>
@endsection