@extends('backend::layouts.app')

@section('title', $title = $video->video_id ? '首页视频编辑页面' : '添加首页视频' )

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
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $video->video_id ? route('video.update', $video->video_id) : route('video.store') }}?redirect={{ previous_url() }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $video->video_id ? 'PATCH' : 'POST' }}">
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">视频名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="video_name" required autocomplete="off" class="form-control" value="{{ old('title',$video->video_name) }}" placeholder="视频名称：分四个季节例如2018春" >
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="" class="col-md-2 col-sm-2 control-label required">ogg格式视频</label>
                            <div class="col-md-3 ">
                                <?php if ($video->video_id): ?>
                                    <span class="ogg">
                                     <video src="{{$img_path}}{{ old('title',$video->video_ogg) }}" controls="controls">
                                    </video></span>
                                    <input class="btn btn-default" type="button" id="ogg" value="更换" >
                                <?php else :?>
                                    <input type="file" required autocomplete="off" name="video_ogg" class="">
                                <?php endif ?> 
                                <span id="ogg_span"></span>                              
                            </div>
                        </div>
                         <div class="form-group ">
                            <label for="" class="col-md-2 col-sm-2 control-label required">webm格式视频</label>
                            <div class="col-md-3 ">
                                <?php if ($video->video_id): ?>
                                    <span class="webm">
                                        <video src="{{$img_path}}{{ old('title',$video->video_webm) }}" controls="controls">
                                        </video>
                                    </span>
                                      <input class="btn btn-default" type="button" id="webm" value="更换" >
                                <?php else :?>
                                    <input type="file" required autocomplete="off" name="video_webm" class="">
                                <?php endif ?> 
                                <span id="webm_span"></span>                              
                            </div>
                        </div>
                         <div class="form-group ">
                            <label for="" class="col-md-2 col-sm-2 control-label required">mp4格式视频</label>
                            <div class="col-md-3 ">
                                <?php if ($video->video_id): ?>
                                    <span class="mp4">
                                      <video src="{{$img_path}}{{ old('title',$video->video_mp4) }}" controls="controls">
                                    </video>
                                    </span>
                                    <input class="btn btn-default" type="button" id="mp4" value="更换" >
                                <?php else :?>
                                    <input type="file" required autocomplete="off" name="video_mp4" class="">
                                <?php endif ?> 
                                <span id="mp4_span"></span>                              
                            </div>
                        </div>
                         <div class="form-group ">
                            <label for="" class="col-md-2 col-sm-2 control-label required">mov格式视频</label>
                            <div class="col-md-3 ">
                                <?php if ($video->video_id): ?>
                                    <!--  <img id="add_file" src="{{$img_path}}{{ old('title',$video->video_mov) }}" alt="{{ old('title',$video->video_name) }}" class="img-thumbnail"> -->
                                    <span class="mov"> <video src="{{$img_path}}{{ old('title',$video->video_mov) }}" controls="controls">
                                    </video>
                                    </span>
                                    <input class="btn btn-default" type="button" id="mov" value="更换" >
                                <?php else :?>
                                    <input type="file" required autocomplete="off" name="video_mov" class="">
                                <?php endif ?> 
                                <span id="mov_span"></span>                              
                            </div>
                        </div>
                         <div class="form-group ">
                            <label for="" class="col-md-2 col-sm-2 control-label required">视频封面</label>
                            <div class="col-md-3 ">
                                <?php if ($video->video_id): ?>
                                     <img id="add_file" src="{{$img_path}}{{ old('title',$video->video_cover) }}" alt="{{ old('title',$video->video_name) }}" class="img-thumbnail">
                                <?php else :?>
                                    <input type="file" required autocomplete="off" name="video_cover" class="">
                                <?php endif ?> 
                                <span id="image"></span>                              
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">发布时间</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" id="datetime" name="video_release_time" required autocomplete="off" class="form-control" value="{{ old('title',$video->video_release_time) }}" placeholder="发布时间格式： yyyy-mm-dd" >
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
        $(document).on("click","#add_file",function(){
            $(this).hide();
            $("#image").html(' <input type="file"  name="video_cover" class="">');
        })
        $(document).on("click","#ogg",function(){
             $(this).hide();
            $(".ogg").hide();
            $("#ogg_span").html(' <input type="file"  name="video_ogg" class="">');
        })
        $(document).on("click","#webm",function(){
             $(this).hide();
            $(".webm").hide();
            $("#webm_span").html(' <input type="file" name="video_webm" class="">');
        })
        $(document).on("click","#mp4",function(){
             $(this).hide();
            $(".mp4").hide();
            $("#mp4_span").html(' <input type="file" name="video_mp4" class="">');
        })
        $(document).on("click","#mov",function(){
             $(this).hide();
            $(".mov").hide();
            $("#mov_span").html(' <input type="file" name="video_mov" class="">');
        })

    </script>
@endsection

@section('scripts')

    @include('backend::common._upload_image_scripts',['elem' => '#upload_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'video', 'object_id' => $video->video_id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'video', 'object_id' => $video->video_id ?? 0 ])

@stop