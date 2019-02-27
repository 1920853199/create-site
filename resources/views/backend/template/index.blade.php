@extends('backend::layouts.app')

@section('title', $title = '模板列表')

@section('breadcrumb')
    <li><a href="javascript:;">模板管理</a></li>
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
                    <a href="{{ route('template.create') }}"  class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                </div>
            </div>

            @if(count($templates))
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
                            <th class="text-center">模板名称</th>
                            <th class="text-center">模板标签</th>
                            <th class="text-center">模板图片</th>
                            <th class="text-center">模板类型</th>
                            <th class="text-center">状态</th>
                            <th class="text-center">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($templates as $index => $template)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $template->name }}</td>
                                <td class="text-center">{{ $template->label }}</td>
                                <td class="text-center"> <img data-toggle="lightbox" data-image="{{ $template->getAvatar() }}" class="img-rounded" data-caption="{{ $template->label }}" src="{{ $template->getAvatar() }}" height="80px" alt=""></td>
                                <td class="text-center">{{ $template->typeValue[$template->type] }}</td>
                                <td class="text-center">
                                    <div class="switch switch-inline">

                                        <input class="status" data-id="{{ $template->id }}" type="checkbox" @if($template->status == 1) checked @endif>
                                        <label>{{ $template->statusValue[$template->status] }}</label>
                                    </div>

                                </td>
                                <td class="text-center">
                                    <a href="{{ route('template.edit', ['id'=>$template->id]) }}" class="btn btn-xs btn-primary">编辑</a>
                                    <a href="javascript:;" data-url="{{ route('template.destroy', ['id'=>$template->id]) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
                <div id="paginate-render">
                    {{$templates->links('pagination::backend')}}
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
            $.post('{{route('template.setStatus')}}',{
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