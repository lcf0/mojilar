@extends('backend::layouts.app')

@section('title', $title = $uplog->uplog_id ? '升级日志编辑页面' : '添加升级日志' )

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
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $uplog->uplog_id ? route('uplog.update', $uplog->uplog_id) : route('uplog.store') }}?redirect={{ previous_url() }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $uplog->uplog_id ? 'PATCH' : 'POST' }}">
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">升级标题</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="uplog_title" required autocomplete="off" class="form-control" value="{{ old('title',$uplog->uplog_title) }}" placeholder="升级标题" >
                            </div>
                        </div>
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="subtitle" class="col-md-2 col-sm-2 control-label required">平台类型</label>
                            <div class="col-md-5 col-sm-10">
                                <select name="uplog_type" required autocomplete="off" class="form-control ">
                                    <option value="">选择平台</option>
                                    <option value="iPhone" 
                                        <?php if ($uplog->uplog_type == 'iPhone'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >iPhone
                                    </option>
                                    <option value="Android"
                                        <?php if ($uplog->uplog_type == 'Android'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >Android
                                    </option>
                                    <option value="Ipad"
                                        <?php if ($uplog->uplog_type == 'Ipad'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >Ipad
                                    </option>
                                     <option value="WP8"
                                        <?php if ($uplog->uplog_type == 'WP8'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >WP8
                                    </option>
                                    <option value="Windows8"
                                        <?php if ($uplog->uplog_type == 'Windows8'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >Windows8
                                    </option>
                                    <option value="Windows"
                                        <?php if ($uplog->uplog_type == 'Windows'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >Windows
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="content" class="col-md-2 col-sm-2 control-label required">升级内容</label>
                            <div class="col-md-8 col-sm-10">
                            <textarea name="uplog_content" id="content" class="form-control editor">{{  old('content', $uplog->uplog_content) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="" class="col-md-2 col-sm-2 control-label required">新版图片</label>
                            <div class="col-md-3 ">
                                <?php if ($uplog->uplog_id): ?>
                                     <img id="add_file" src="{{$img_path}}{{ old('title',$uplog->uplog_img) }}" alt="{{ old('title',$uplog->uplog_title) }}" class="img-thumbnail">
                                <?php else :?>
                                    <input type="file" required autocomplete="off" name="uplog_img" class="">
                                <?php endif ?> 
                                <span id="image"></span>                              
                            </div>
                        </div>


                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">下载地址</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="uplog_down_link" required autocomplete="off" class="form-control" value="{{ old('title',$uplog->uplog_down_link) }}" placeholder="下载地址" >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">发布日期</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" id="datetime" name="uplog_release_time" required autocomplete="off" class="form-control" value="{{ old('title',$uplog->uplog_release_time) }}" placeholder="发布日期格式： yyyy-mm-dd" >
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
            $("#image").html(' <input type="file" required autocomplete="off" name="uplog_img" class="">');
        })
    </script>
@endsection

@section('styles')
    @include('backend::common._editor_styles')
@stop

@section('scripts')
    @include('backend::common._editor_scripts',['folder'=>'website'])

    @include('backend::common._upload_image_scripts',['elem' => '#upload_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'uplog', 'object_id' => $uplog->uplog_id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'uplog', 'object_id' => $uplog->uplog_id ?? 0 ])

@stop