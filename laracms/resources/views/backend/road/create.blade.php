@extends('backend::layouts.app')

@section('title', $title = $road->road_id ? '编辑页面' : '添加页面' )

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
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $road->road_id ? route('road.update', $road->road_id) : route('road.store') }}?redirect={{ previous_url() }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $road->road_id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">事件名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="road_name" required autocomplete="off" class="form-control" value="{{ old('title',$road->road_name) }}" >
                            </div>
                        </div>
                       <!--  <div class="form-group has-feedback  has-icon-right">
                            <label for="keywords" class="col-md-2 col-sm-2 control-label">关键词</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="keywords" autocomplete="off" class="form-control" value="{{ old('keywords',$road->keywords) }}" >
                            </div>
                        </div> -->

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="content" class="col-md-2 col-sm-2 control-label required">事件内容</label>
                            <div class="col-md-8 col-sm-10">
                            <textarea name="road_content" id="content" class="form-control editor">{{  old('content', $road->road_content) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="" class="col-md-2 col-sm-2 control-label ">图片上传</label>
                            <div class="col-md-3 ">
                                <input type="file" name="road_img_path" class="">
                            </div>
                        </div>

                        <!-- <div class="form-group has-feedback  has-icon-right">

                                <label class="col-md-2 col-sm-2 control-label">上传图片</label>
                                <div class="col-md-8 col-sm-10">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <img src="{{ storage_image_url($road->thumb) }}" id="image_image" class="img-rounded" width="660px" height="300px" alt="">
                                            <input type="hidden" name="image" id="form_thumb" value="{{ old('thumb',$road->thumb) }}" />
                                            <button id="upload_thumb" type="button" class="btn btn-info uploader-btn-browse"><i class="icon icon-upload"></i> 上传</button>
                                            <button id="select_thumb" type="button" class="btn btn-primary"><i class="icon icon-file-image"></i> 选择</button>
                                            <button id="delete_thumb" type="button" class="btn btn-danger"><i class="icon icon-remove-sign"></i> 删除</button>
                                        </div>
                                    </div>
                                </div>
                        </div> -->

                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">状态</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="road_ishow" value="0" @if($road->road_ishow == 0) checked="" @endif required > 隐藏
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="road_ishow" value="1" @if($road->road_ishow == 1) checked="" @endif required > 显示
                                </label>
                            </div>
                            </div>
                        </div>
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">发布时间</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" id="datetime" name="road_release_time" required autocomplete="off" class="form-control" value="{{ old('title',$road->road_release_time) }}" >
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

    @include('backend::common._upload_image_scripts',['elem' => '#upload_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'road', 'object_id' => $road->road_id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'road', 'object_id' => $road->road_id ?? 0 ])

@stop