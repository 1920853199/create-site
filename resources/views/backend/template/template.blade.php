<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="{{asset('vendor/laracms/plugins/zui/css/zui.min.css')}}">

<ul class="nav nav-tabs" style="margin: 20px 5%">
    <li class="active"><a data-tab href="#tabContent1">全部</a></li>
    <li><a data-tab href="#tabContent2">响应式</a></li>
    <li><a data-tab href="#tabContent3">PC</a></li>
    <li><a data-tab href="#tabContent4">移动</a></li>
</ul>
<div class="tab-content" style="margin: 20px 5%">
    <div class="tab-pane active" id="tabContent1">
        @if(count($templates))
            <div class="cards" style="margin: 20px 0px">
                @foreach($templates as $index => $template)
                    <div class="col-md-4" style="float: left;">
                        <div class="card">
                            <div class="media-wrapper">
                                <img height="367px" src="{{$template->getAvatar()}}" alt="{{$template->label}}">
                            </div>
                            <div class="caption">{{$template->label}}</div>
                            <div class="card-heading">
                                <button type="button" data-name="{{$template->name}}" data-site="{{$request->site}}" class="btn preview"><i class="icon-hand-right"></i> 预览</button>
                                <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="1" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i> PC端</button>
                                <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="2" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i> 移动端</button>
                                <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="0" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i> 同时设置</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info alert-block">暂无可使用模板.</div>
        @endif
    </div>
    <div class="tab-pane" id="tabContent2">
        @if(count($templates))
            <div class="cards" style="margin: 20px 0px">
                <?php
                    $i = 0;
                ?>
                @foreach($templates as $index => $template)
                    @if($template->type == 0)
                        <?php
                            $i ++;
                        ?>
                        <div class="col-md-4" style="float: left;">
                            <div class="card">
                                <div class="media-wrapper">
                                    <img height="367px" src="{{$template->getAvatar()}}" alt="{{$template->label}}">
                                </div>
                                <div class="caption">{{$template->label}}</div>
                                <div class="card-heading">
                                    <button type="button" data-name="{{$template->name}}" data-site="{{$request->site}}" class="btn preview"><i class="icon-hand-right"></i> 预览</button>
                                    <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="1" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i> PC端</button>
                                    <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="2" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i> 移动端</button>
                                    <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="0" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i> 同时设置</button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($i == 0)
                    <div class="alert alert-info alert-block">暂无可使用模板.</div>
                @endif
            </div>
        @else
            <div class="alert alert-info alert-block">暂无可使用模板.</div>
        @endif
    </div>
    <div class="tab-pane" id="tabContent3">
        @if(count($templates))
            <div class="cards" style="margin: 20px 0px">
                <?php
                    $i = 0;
                ?>
                @foreach($templates as $index => $template)
                    @if($template->type == 1)
                        <?php
                            $i++;
                        ?>
                        <div class="col-md-4" style="float: left;">
                            <div class="card">
                                <div class="media-wrapper">
                                    <img height="367px" src="{{$template->getAvatar()}}" alt="{{$template->label}}">
                                </div>
                                <div class="caption">{{$template->label}}</div>
                                <div class="card-heading">
                                    <button type="button" data-name="{{$template->name}}" data-site="{{$request->site}}" class="btn preview"><i class="icon-hand-right"></i> 预览</button>
                                    <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="1" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i>PC端</button>
                                    <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="2" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i>移动端</button>
                                    <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="0" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i>同时设置</button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($i == 0)
                    <div class="alert alert-info alert-block">暂无可使用模板.</div>
                @endif
            </div>
        @else
            <div class="alert alert-info alert-block">暂无可使用模板.</div>
        @endif
    </div>
    <div class="tab-pane" id="tabContent4">
        @if(count($templates))
            <div class="cards" style="margin: 20px 0px">
                <?php
                    $i = 0;
                ?>
                @foreach($templates as $index => $template)
                    @if($template->type == 2)
                        <?php
                            $i++;
                        ?>
                        <div class="col-md-4" style="float: left;">
                            <div class="card">
                                <div class="media-wrapper">
                                    <img height="367px" src="{{$template->getAvatar()}}" alt="{{$template->label}}">
                                </div>
                                <div class="caption">{{$template->label}}</div>
                                <div class="card-heading">
                                    <button type="button" data-name="{{$template->name}}" data-site="{{$request->site}}" class="btn preview"><i class="icon-hand-right"></i> 预览</button>
                                    <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="1" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i> PC端</button>
                                    <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="2" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i> 移动端</button>
                                    <button data-name="{{$template->name}}" data-site="{{$request->site}}" data-type="0" type="button" class="btn btn-danger use_template"><i class="icon-heart"></i> 同时设置</button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($i == 0)
                    <div class="alert alert-info alert-block">暂无可使用模板.</div>
                @endif
            </div>
        @else
            <div class="alert alert-info alert-block">暂无可使用模板.</div>
        @endif
    </div>
</div>

<script src="{{asset('vendor/laracms/js/jquery-1.9.1.min.js')}}"></script>
<script src="{{asset('vendor/laracms/plugins/zui/js/zui.min.js')}}"></script>
<script>
    $(function () {
        // 模板使用状态
        $(".use_template").click(function() {
            var name = $(this).attr('data-name');
            var site = $(this).attr('data-site');
            var type = $(this).attr('data-type');
            $.post('{{route('template.use')}}',{
                'name':name,
                'site':site,
                'type':type,
                '_token':'{{csrf_token()}}'
            },function (data) {
                new $.zui.Messager(data.msg, {
                    type:'success',
                }).show();
            });

        });

        // 模板使用状态
        $(".preview").click(function() {
            var name = $(this).attr('data-name');
            var site = $(this).attr('data-site');
            $.post('{{route('template.preview')}}',{
                'name':name,
                'site':site,
                '_token':'{{csrf_token()}}'
            },function (data) {
                if(data.code == 200){
                    window.parent.open(data.data)
                }
            });

        });
    });
</script>
