@extends('backend::layouts.app')

@section('title', $title = $img->img_id ? '图片编辑页面' : '添加图片' )

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
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $img->img_id ? route('img.update', $img->img_id) : route('img.store') }}?redirect={{ previous_url() }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $img->img_id ? 'PATCH' : 'POST' }}">

                          <div class="form-group has-feedback  has-icon-right">
                            <label for="subtitle" class="col-md-2 col-sm-2 control-label">关于墨迹</label>
                            <div class="col-md-5 col-sm-10">
                                <select name="img_type"  class="form-control">
                                    <option value="关于墨迹" 
                                        <?php if ($img->img_type == '关于墨迹'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >关于墨迹
                                    </option>
                                    <option value="墨迹之路"
                                        <?php if ($img->img_type == '墨迹之路'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >墨迹之路
                                    </option>
                                    <option value="墨迹动态"
                                        <?php if ($img->img_type == '墨迹动态'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >墨迹动态
                                    </option>
                                    <option value="商务合作"
                                        <?php if ($img->img_type == '商务合作'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >商务合作
                                    </option>
                                    <option value="品牌案例"
                                        <?php if ($img->img_type == '品牌案例'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >品牌案例
                                    </option>
                                    <option value="加入我们"
                                        <?php if ($img->img_type == '加入我们'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >加入我们
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="" class="col-md-2 col-sm-2 control-label required">新版图片</label>
                            <div class="col-md-3 ">
                                <?php if ($img->img_id): ?>
                                     <img id="add_file" src="{{$img_path}}{{ old('title',$img->img_path) }}" alt="{{ old('title',$img->img_type) }}" class="img-thumbnail">
                                <?php else :?>
                                    <input type="file" required autocomplete="off" name="img_path" class="">
                                <?php endif ?> 
                                <span id="image"></span>                              
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">发布日期</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" id="datetime" name="img_release_time" required autocomplete="off" class="form-control" value="{{ old('title',$img->img_release_time) }}" placeholder="发布日期格式： yyyy-mm-dd" >
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
            $("#image").html(' <input type="file" required autocomplete="off" name="img_path" class="">');
        })
    </script>
@endsection

@section('styles')
    @include('backend::common._editor_styles')
@stop

@section('scripts')
    @include('backend::common._editor_scripts',['folder'=>'website'])

    @include('backend::common._upload_image_scripts',['elem' => '#upload_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'img', 'object_id' => $img->img_id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'img', 'object_id' => $img->img_id ?? 0 ])

@stop