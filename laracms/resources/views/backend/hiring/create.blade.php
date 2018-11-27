@extends('backend::layouts.app')

@section('title', $title = $hiring->hiring_id ? '岗位招聘编辑页面' : '添加岗位招聘' )

@section('navigation')

@endsection

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">页面管理</a></li>
    <li class="active">{{$title}}</li>
@endsection
@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $hiring->hiring_id ? route('hiring.update', $hiring->hiring_id) : route('hiring.store') }}?redirect={{ previous_url() }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $hiring->hiring_id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">岗位名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="hiring_name" required autocomplete="off" class="form-control" value="{{ old('title',$hiring->hiring_name) }}" placeholder="招聘岗位名称" >
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="" class="col-md-2 col-sm-2 control-label ">岗位照片</label>
                            <div class="col-md-3 ">
                                <input type="file" name="hiring_img" class="">
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="content" class="col-md-2 col-sm-2 control-label required">岗位说明</label>
                            <div class="col-md-8 col-sm-10">
                            <textarea name="hiring_content" id="content" class="form-control editor">{{  old('content', $hiring->hiring_content) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">发布日期</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" id="datetime" name="hiring_release_time" required autocomplete="off" class="form-control" value="{{ old('title',$hiring->hiring_release_time) }}" placeholder="发布日期格式： yyyy-mm-dd" >
                            </div>
                        </div>
                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">状态</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="hiring_ishow" value="0" @if($hiring->hiring_ishow == 0) checked="" @endif required > 隐藏
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="hiring_ishow" value="1" @if($hiring->hiring_ishow == 1) checked="" @endif required > 显示
                                </label>
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-5 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn">提交</button>
                                <button type="reset" class="btn btn-default">重置</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/zui/1.8.1/css/zui.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/zui/lib/datetimepicker/datetimepicker.min.css')}}">
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/zui/lib/datetimepicker/datetimepicker.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $("#datetime").datetimepicker(
        {
            language:  "zh-CN",
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            format: "yyyy-mm-dd"
        });
        $(document).on("blur","#datetime",function(){
            if ($("#datetime").val()) {             
                  $('#btn').attr("disabled",false);   
             } else{
                $('#btn').attr("disabled",true);    
             }   
        })
    </script>
@endsection

@section('styles')
    @include('backend::common._editor_styles')
@stop

@section('scripts')
    @include('backend::common._editor_scripts',['folder'=>'website'])

    @include('backend::common._upload_image_scripts',['elem' => '#upload_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'hiring', 'object_id' => $hiring->hiring_id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'hiring', 'object_id' => $hiring->hiring_id ?? 0 ])

@stop