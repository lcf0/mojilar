@extends('backend::layouts.app')

@section('title', $title = $brand->brand_id ? '品牌案例编辑页面' : '添加品牌案例' )

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
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $brand->brand_id ? route('brand.update', $brand->brand_id) : route('brand.store') }}?redirect={{ previous_url() }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $brand->brand_id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">案例名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="brand_name" required autocomplete="off" class="form-control" value="{{ old('title',$brand->brand_name) }}" placeholder="案例名称" >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="subtitle" class="col-md-2 col-sm-2 control-label">案例类型</label>
                            <div class="col-md-5 col-sm-10">
                                <select name="brand_type"  class="form-control">
                                    <option value="H5首页" 
                                    <?php if ($brand->brand_type == 'H5首页'): ?>
                                        <?php echo 'selected'; ?>
                                    <?php endif ?>
                                    >H5首页</option>
                                    <option value="开屏"
                                    <?php if ($brand->brand_type == '开屏'): ?>
                                        <?php echo 'selected'; ?>
                                    <?php endif ?>
                                    >开屏</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="" class="col-md-2 col-sm-2 control-label ">案例照片</label>
                            <div class="col-md-3 " id="img">
                                <ul id='ul' class="list-group">
                                    <li class="img list-group-item">
                                        <input type="file" name="brand_img1">
                                    </li>
                                    <li class="img list-group-item">
                                        <input type="file" name="brand_img2">
                                    </li>
                                    <li class="img list-group-item">
                                        <input type="file" name="brand_img3">
                                    </li><!-- $("input[type='password']") -->
                                </ul>
                                 <a href="javascript:void(0)" class="btn btn-success btn-md" id="add"><i class=" icon-plus-sign"></i> 添加 </a>
                                 <a href="javascript:void(0)" class="btn btn-danger btn-md" id="remove"><i class=" icon-minus-sign" ></i> 删除 </a>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="content" class="col-md-2 col-sm-2 control-label required">案例说明</label>
                            <div class="col-md-8 col-sm-10">
                            <textarea name="brand_content" id="content" class="form-control editor">{{  old('content', $brand->brand_content) }}</textarea>
                            </div>
                        </div>

                         <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">上线时间段</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="brand_online_time" required autocomplete="off" class="form-control" value="{{ old('title',$brand->brand_name) }}" placeholder="上线时间段（手动添加文本）" >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">发布日期</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" id="datetime" name="brand_release_time" required autocomplete="off" class="form-control" value="{{ old('title',$brand->brand_release_time) }}" placeholder="发布日期格式： yyyy-mm-dd" >
                            </div>
                        </div>
                        <div class="form-group has-feedback has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label required">状态</label>
                            <div class="col-md-5 col-sm-10">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="brand_ishow" value="0" @if($brand->brand_ishow == 0) checked="" @endif required > 隐藏
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="brand_ishow" value="1" @if($brand->brand_ishow == 1) checked="" @endif required > 显示
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
        $(document).on("click","#add",function(){

            if ($(".img").length >= 5) {
                $(this).hide()
            }
            if ($(".img").length >= 3) {
                $("#remove").show();
            }
            $("#ul").append('<li class="img list-group-item"> <input type="file" name="brand_img'+($(".img").length+1) +'"> </li>');
            

        })
        $(document).on("click","#remove",function(){
            if ($(".img").length <= 4) {
                $(this).hide()
            }
            $("#ul").children("li:last").remove();
            if ($(".img").length <= 6) {
                $("#add").show()
            }
        })

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

    @include('backend::common._upload_image_scripts',['elem' => '#upload_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'brand', 'object_id' => $brand->brand_id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'brand', 'object_id' => $brand->brand_id ?? 0 ])

@stop