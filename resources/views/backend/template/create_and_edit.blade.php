@extends('backend::layouts.app')

@section('title', $title = $templates->id ? '编辑模板' : '添加模板' )

@section('breadcrumb')
    <li><a href="{{route('template.index')}}">模板管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">

                    <form id="form-validator" method="POST" class="form-horizontal" action="{{ $templates->id ? route('template.update', $templates->id) : route('template.store') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $templates->id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">模板标签</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="label" name="label" autocomplete="off" placeholder="" value="{{ old('label',$templates->label) }}"
                                   required
                                   data-fv-trigger="blur"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">模板名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="" value="{{ old('name',$templates->name) }}"
                                   required
                                   data-fv-trigger="blur"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">模板类型</label>
                            <div class="col-md-5 col-sm-10">
                                <select class="form-control" id="type" name="type">
                                    @foreach($templates->typeValue as $index => $value)
                                        <option value="{{$index}}" @if($templates->type == $index) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 col-sm-2 control-label">模板描述</label>
                            <div class="col-md-5 col-sm-10">
                                <textarea class="form-control" name="remark">{{ old('remark',$templates->remark) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 col-sm-2">模板图片</label>
                            <div class="col-md-5 col-sm-10">
                                <div class="panel">
                                    <div class="panel-body">
                                        <img src="{{ $templates->getAvatar() }}" id="image_avatar" class="img-rounded" width="200px" height="200px" alt="">
                                        <input type="hidden" name="images" id="form_avatar" value="{{ old('images',$templates->images) }}" />
                                        <button id="avatar" type="button" class="btn btn-info uploader-btn-browse"><i class="icon icon-upload"></i> 上传图片</button>
                                    </div>
                                </div>
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

@section('scripts')
    @include('backend::common._upload_image_scripts',['elem' => '#avatar', 'previewElem' => '#image_avatar', 'fieldElem' => '#form_avatar', 'folder'=>'template', 'object_id' => Auth::User()->id ])
@endsection