@extends('backend::layouts.app')

@section('title', $title = $groups->id ? '编辑站点' : '创建站点' )

@section('breadcrumb')
    <li><a href="{{route('administrator.group.index')}}">站点管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{$groups->id ? route('administrator.group.update'):route('administrator.group.save')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="{{ $groups->id ? 'PATCH' : 'POST' }}">
                        @if ($groups->id)
                            <input type="hidden" name="id" value="{{ $groups->id }}" />
                        @endif
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="site_name" class="col-md-2 col-sm-2 control-label required">站点名称</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="text" name="site_name" id="site_name" autocomplete="off" placeholder="" class="form-control" value="{{ old('site_name',$groups->site_name) }}"
                                       required
                                       data-fv-trigger="blur"
                                       minlength="1"
                                       maxlength="128"
                                >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="domain" class="col-md-2 col-sm-2 control-label required">域名</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="url" name="domain" id="domain" autocomplete="off" placeholder="" class="form-control" value="{{ old('domain',$groups->domain) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="director" class="col-md-2 col-sm-2 control-label required">负责人</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="director" autocomplete="off" placeholder="" class="form-control" value="{{ old('director',$groups->director) }}"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="phone" class="col-md-2 col-sm-2 control-label required">手机</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="tel" name="phone" autocomplete="off" placeholder="" class="form-control" value="{{ old('phone',$groups->phone) }}"
                                       required
                                       data-fv-trigger="blur"
                                       minlength="1"
                                       maxlength="128"
                                >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="email" class="col-md-2 col-sm-2 control-label required">邮箱</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="email" name="email" autocomplete="off" placeholder="" class="form-control" value="{{ old('email',$groups->email) }}"
                                       required
                                       data-fv-trigger="blur"
                                       minlength="1"
                                       maxlength="128"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5 col-sm-10">
                                <button type="submit" class="btn btn-primary">提交</button>
                                <a href="{{route('administrator.group.index')}}" class="btn btn-default">返回</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection