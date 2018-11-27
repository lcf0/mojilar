@extends('backend::layouts.app')

@section('title', $title = '添加介绍')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">关于墨迹</a></li>
    <li class="active">{{$title}}</li>
@endsection
<link rel="stylesheet" type="text/css" href="{{asset('plugins/date/css/bootstrap-datetimepicker.min.css')}}">
@section('content')
<h3 class="header-dividing text-danger" >添加介绍<small></small></h3>
<div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ route('about.create')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="name" class="col-md-2 col-sm-2 control-label required">标题</label>
                            <div class="col-md-3 col-sm-10">
                            <input type="text" name="about_titile" autocomplete="off" class="form-control" value=""
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128"
                            ></div>
                        </div>
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="parent" class="col-md-2 col-sm-2 control-label required">关于墨迹</label>
                            <div class="col-md-3 col-sm-10">
                                <select data-placeholder="请选择父级菜单" class="form-control"  tabindex="2" name="about_type">
                                    <option value="关于墨迹">关于墨迹</option>
                                    <option value="商务合作">商务合作</option>                               
                                </select>
                             </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="keywords" class="col-md-2 col-sm-2 control-label required" id="keywords">介绍</label>
                            <div class="col-md-3 col-sm-10">
                                <script id="editor" type="text/plain" style="width:1024px;height:500px;"></script>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="" class="col-md-2 col-sm-2 control-label ">图片上传</label>
                            <div class="col-md-3 ">
                                <input type="file" name="about_img_path" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="link" class="col-md-2 col-sm-2 control-label required">发布日期</label>
                            <div class="col-md-3 col-sm-10">
                                <input size="16" type="text" name="about_release_time" value="" readonly class="form_datetime form-control"
                                   required
                                   data-fv-trigger="blur"
                                   minlength="1"
                                   maxlength="128">
                           </div>
                        </div> 

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-3 col-sm-10">
                                <input type="hidden" name="type" value="">
                                <button type="submit" class="btn btn-primary" id="btn">提交</button>
                                <button type="reset" class="btn btn-default">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   <!--  注意引入js顺序 -->
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/ueditor/ueditor.config.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/ueditor/ueditor.all.min.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/date/js/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/date/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script type="text/javascript"> 
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii' });
    //失去焦点
    $("#form-validator").submit(function(e){
          if(UE.getEditor('editor').hasContents()){
            $('#btn').attr("disabled",false); 
            }else{
                $('#btn').attr("disabled",true); 
            };
        });
    UE.getEditor('editor').addListener('blur',function(editor){
        if(UE.getEditor('editor').hasContents()){
            $('#btn').attr("disabled",false);          
        }else{
            $('#btn').attr("disabled",true); 
        };
    });
</script>         
@endsection

@section('scripts')

@endsection