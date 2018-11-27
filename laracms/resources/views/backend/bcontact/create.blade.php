@extends('backend::layouts.app')

@section('title', $title = $bcontact->bcontact_id ? '商务合作联系方式编辑页面' : '添加商务合作联系方式' )

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
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $bcontact->contact_id ? route('bcontact.update', $bcontact->contact_id) : route('bcontact.store') }}?redirect={{ previous_url() }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $bcontact->contact_id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="contact_name" class="col-md-2 col-sm-2 control-label required">合作名称</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="contact_name" required autocomplete="off" class="form-control" value="{{ old('contact_name',$bcontact->contact_name) }}" placeholder="合作名称" >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="contact_people" class="col-md-2 col-sm-2 control-label required">联系人</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="contact_people" required autocomplete="off" class="form-control" value="{{ old('contact_people',$bcontact->contact_people) }}" placeholder="联系人" >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="contact_tel" class="col-md-2 col-sm-2 control-label required">联系电话</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="contact_tel" required autocomplete="off" class="form-control" value="{{ old('contact_tel',$bcontact->contact_tel) }}" placeholder="联系电话" >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="contact_email" class="col-md-2 col-sm-2 control-label required">邮箱</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="contact_email" required autocomplete="off" class="form-control" value="{{ old('contact_email',$bcontact->contact_email) }}" placeholder="邮箱例如：12345@qq.com" >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="contact_qq" class="col-md-2 col-sm-2 control-label required">QQ</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="contact_qq" required autocomplete="off" class="form-control" value="{{ old('contact_qq',$bcontact->contact_qq) }}" placeholder="QQ" >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">发布日期</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" id="datetime" name="contact_release_time" required autocomplete="off" class="form-control" value="{{ old('title',$bcontact->contact_release_time) }}" placeholder="发布日期格式： yyyy-mm-dd" >
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


@section('scripts')

    @include('backend::common._upload_image_scripts',['elem' => '#upload_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'contact', 'object_id' => $bcontact->contact_id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'contact', 'object_id' => $bcontact->contact_id ?? 0 ])

@stop