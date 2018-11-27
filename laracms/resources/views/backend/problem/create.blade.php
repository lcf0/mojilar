@extends('backend::layouts.app')

@section('title', $title = $problem->problem_id ? '常见问题编辑页面' : '添加常见问题' )

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
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $problem->problem_id ? route('problem.update', $problem->problem_id) : route('problem.store') }}?redirect={{ previous_url() }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $problem->problem_id ? 'PATCH' : 'POST' }}">

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="subtitle" class="col-md-2 col-sm-2 control-label required">平台类型</label>
                            <div class="col-md-5 col-sm-10">
                                <select name="problem_type" required autocomplete="off" class="form-control ">
                                    <option value="">选择平台</option>
                                    <option value="iPhone" 
                                        <?php if ($problem->problem_type == 'iPhone'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >iPhone
                                    </option>
                                    <option value="Android"
                                        <?php if ($problem->problem_type == 'Android'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >Android
                                    </option>

                                     <option value="WP8"
                                        <?php if ($problem->problem_type == 'WP8'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >WP8
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="content" class="col-md-2 col-sm-2 control-label required">问题</label>
                            <div class="col-md-8 col-sm-10">
                            <textarea name="problem_ask" required autocomplete="off" class="form-control">{{  old('content', $problem->problem_ask) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="content" class="col-md-2 col-sm-2 control-label required">回答</label>
                            <div class="col-md-8 col-sm-10">
                            <textarea name="problem_answer" required autocomplete="off" class="form-control">{{  old('content', $problem->problem_answer) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">添加日期</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" id="datetime" name="problem_release_time" required autocomplete="off" class="form-control" value="{{ old('title',$problem->problem_release_time) }}" placeholder="发布日期格式： yyyy-mm-dd" >
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
    @include('backend::common._upload_image_scripts',['elem' => '#upload_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'problem', 'object_id' => $problem->problem_id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'problem', 'object_id' => $problem->problem_id ?? 0 ])

@stop