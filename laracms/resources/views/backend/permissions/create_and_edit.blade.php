@extends('backend::layouts.app')

@section('title', $title = $permission->id ? '编辑权限' : '添加权限' )

@section('breadcrumb')
    <li><a href="javascript:;">系统设置</a></li>
    <li><a href="javascript:;">权限管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
<link  href="{{asset('css/permissions/font-awesome.min.css')}}" rel="stylesheet">

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$title}}</h3>
                        </div>
                        <div class="panel-body">

                                                        
     <form id="form-validator" class="form-horizontal" method="POST" action="{{ $permission->id ? route('permissions.update', $permission->id) : route('permissions.store') }}?redirect={{ previous_url() }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $permission->id ? 'PATCH' : 'POST' }}">
        <input name="cove_image" type="hidden">
        <div class="form-group">
    <label for="tag" class="col-md-3 control-label">权限规则</label>
    <div class="col-md-6">
        <input class="form-control" name="name" id="tag" value="{{ old('name',$permission->name) }}" autofocus="" type="text">
        @if(isset($cid))
            <input class="form-control" name="grade" id="tag" value="1" autofocus="" type="hidden">
                <input class="form-control" name="parent_id" id="tag" value="{{$cid}}" autofocus="" type="hidden">
            @else
                <input class="form-control" name="parent_id" id="tag" value="" autofocus="" type="hidden">
                <input class="form-control" name="grade" id="tag" value="0" autofocus="" type="hidden">
        @endif
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">权限名称</label>
    <div class="col-md-6">
        <input class="form-control" name="remarks" id="tag" value="{{ old('name',$permission->remarks) }}" autofocus="" type="text">
    </div>
</div>

    <link rel="stylesheet" href="{{asset('css/permissions/bootstrap-iconpicker.min.css')}}">

    <div class="form-group" style="display: <?php
    if (isset($cid)) {
        echo 'none';
    }else{
        echo $permission->id ? 'none' : 'block';
    }
    
    ?> ">>
    <label for="tag" class="col-md-3 control-label">图标</label>
    <div class="col-md-6">
        <!-- Button tag -->
        <button class="btn btn-default iconpicker" name="icon" data-iconset="fontawesome" data-icon="icon-sliders" role="iconpicker" data-original-title="" title=""><i class="icon-ort-asc"></i><input name="icon" value="icon-sort-asc" type="hidden"><span class="caret"></span></button>
    </div>

    </div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">权限概述</label>
    <div class="col-md-6">
        <textarea name="summary" class="form-control" rows="3">{{ old('name',$permission->summary) }}</textarea>
    </div>
</div>

            <div class="form-group">
                <div class="col-md-7 col-md-offset-3">
                    <button type="submit" class="btn btn-primary btn-md">
                        <i class="icon-plus-sign"></i>
                        添加
                    </button>
                </div>
            </div>

        </form>

                        </div>
                    </div>
                </div>
    </div>
@endsection

@section('scripts')
@endsection