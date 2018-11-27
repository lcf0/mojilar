@extends('backend::layouts.app')

@section('title', $title = $issue->issue_id ? '发版信息编辑页面' : '添加发版信息' )

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
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ $issue->issue_id ? route('issue.update', $issue->issue_id) : route('issue.store') }}?redirect={{ previous_url() }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="{{ $issue->issue_id ? 'PATCH' : 'POST' }}">
                        <div class="form-group has-feedback  has-icon-right">
                            <label for="subtitle" class="col-md-2 col-sm-2 control-label">移动版本</label>
                            <div class="col-md-5 col-sm-10">
                                <select name="issue_type"  class="form-control">
                                    <option value="移动版本" 
                                        <?php if ($issue->issue_type == '移动版本'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >移动版本
                                    </option>
                                    <option value="Pad版本"
                                        <?php if ($issue->issue_type == 'Pad版本'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >Pad版本
                                    </option>
                                    <option value="TV版本"
                                        <?php if ($issue->issue_type == 'TV版本'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >TV版本
                                    </option>
                                    <option value="国际版本"
                                        <?php if ($issue->issue_type == '国际版本'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >国际版本
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="subtitle" class="col-md-2 col-sm-2 control-label">iPhone</label>
                            <div class="col-md-5 col-sm-10">
                                <select name="issue_terrace_name"  class="form-control">
                                    <option value="iPhone" 
                                        <?php if ($issue->issue_terrace_name == 'iPhone'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >iPhone
                                    </option>
                                    <option value="Android"
                                        <?php if ($issue->issue_terrace_name == 'Android'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >Android
                                    </option>
                                    <option value="Symbian"
                                        <?php if ($issue->issue_terrace_name == 'Symbian'): ?>
                                            <?php echo 'selected'; ?>
                                        <?php endif ?>
                                        >Symbian
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">版本号</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="issue_num" required autocomplete="off" class="form-control" value="{{ old('title',$issue->issue_num) }}" placeholder="版本号" >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">下载地址</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" name="issue_link" required autocomplete="off" class="form-control" value="{{ old('title',$issue->issue_link) }}" placeholder="下载地址" >
                            </div>
                        </div>

                        <div class="form-group has-feedback  has-icon-right">
                            <label for="title" class="col-md-2 col-sm-2 control-label required">发布日期</label>
                            <div class="col-md-5 col-sm-10">
                            <input type="text" id="datetime" name="issue_release_time" required autocomplete="off" class="form-control" value="{{ old('title',$issue->issue_release_time) }}" placeholder="发布日期格式： yyyy-mm-dd" >
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

    @include('backend::common._upload_image_scripts',['elem' => '#upload_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'issue', 'object_id' => $issue->issue_id ?? 0 ])
    @include('backend::common._delete_image_scripts',['elem' => '#delete_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', ])
    @include('backend::common._select_image_scripts',['elem' => '#select_thumb', 'previewElem' => '#image_image', 'fieldElem' => '#form_thumb', 'folder'=>'issue', 'object_id' => $issue->issue_id ?? 0 ])

@stop