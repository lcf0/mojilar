@extends('backend::layouts.app')

@section('title', $title = '基本信息')

@section('breadcrumb')
    <li><a href="javascript:;">系统设置</a></li>
    <li><a href="javascript:;">用户管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
<!-- <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/upload/fileinput-rtl.css')}}">
<link type="text/css" href="{{asset('bootstrap/css/upload/fileinput.css')}}" rel="stylesheet"> -->
<link type="text/css" href="{{asset('bootstrap/css/upload/fileinput.min.css')}}" rel="stylesheet">
<!-- <link type="text/css" href="{{asset('css/permissions/font-awesome.css')}}" rel="stylesheet"> -->
<link type="text/css" href="{{asset('css/permissions/bootstrap.min.css')}}" rel="stylesheet">
<!-- <script src="{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script> -->

<!-- <link href="{{asset('bootstrap/css/upload//themes/explorer-fa/theme.css')}}" media="all" rel="stylesheet" type="text/css"/> -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- <script src="{{asset('bootstrap/js/upload/plugins/sortable.js')}}" type="text/javascript"></script> -->

<script src="{{asset('bootstrap/js/upload/fileinput.js')}}" type="text/javascript"></script>
<!-- <script src="{{asset('bootstrap/js/upload/locales/fr.js')}}" type="text/javascript"></script> -->
<!-- <script src="{{asset('bootstrap/js/upload/locales/es.js')}}" type="text/javascript"></script>
<script src="{{asset('bootstrap/themes/explorer-fa/theme.js')}}" type="text/javascript"></script> -->
<script src="{{asset('bootstrap/themes/fa/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('bootstrap/js/upload/poper.min.js')}}" type="text/javascript"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script> -->
    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form id="form-validator" class="form-horizontal" method="POST" action="{{ route('user.update', Auth::User()->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" class="mini-hidden" value="PATCH">

                        <div class="form-group">
                            <label class="col-md-2 col-sm-2">用户名</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="text" class="form-control" readonly name="name" lay-verify="required" autocomplete="off" value="{{ old('name',$user->name) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-2">邮箱</label>
                            <div class="col-md-5 col-sm-10">
                                <input type="email" name="email" readonly autocomplete="off" class="form-control" value="{{ old('email',$user->email) }}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-2">个人简介</label>
                            <div class="col-md-5 col-sm-10">
                                <textarea class="form-control" rows="4" name="introduction">{{ old('introduction',$user->introduction) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-2">头像</label>
                            <!-- <input type="file" name="avatar"> -->
                             <!-- <div class="file-loading" style="width: 300px;height: 300px">
                                <input id="kv-explorer" type="file" multiple>
                                </div> -->
                                <!-- <br> -->
                                <!-- <div class="row" style="height: 500px">
                                <input id="file-Portrait1" type="file">
                                </div> -->
                                <div class="file_box">
                                     <input id="input-b3" name="avatar" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
                                </div>
                                
                                    <!-- <input id="file-0a" class="file" type="file" multiple data-min-file-count=""> -->
                                
                            <!-- <div class="col-md-5 col-sm-10">
                                <div class="panel">
                                    <div class="panel-body">
                                        <img src="{{ $user->getAvatar() }}" id="image_avatar" class="img-rounded" width="100px" height="100px" alt="">
                                        <input type="hidden" name="avatar" id="form_avatar" value="{{ old('avatar',$user->avatar) }}" /> -->
                                        <!-- <input type="file" name="avatar"  multiple="true"> -->                                
                                        <!-- <button id="avatar" type="button" class="btn btn-info uploader-btn-browse"><i class="icon icon-upload"></i> 上传头像</button> -->
                                 <!--    </div>
                                </div> -->
                            </div>
                        
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">提交</button>
                            <button type="reset" class="btn btn-default">重置</button>
                            </div>
                        </div>
                  
                    </form>
                </div>
           
            </div>
        </div>
    </div>
<script>
    
    // $('#file-fr').fileinput({
    //     theme: 'fa',
    //     language: 'fr',
    //     uploadUrl: '#',
    //     allowedFileExtensions: ['jpg', 'png', 'gif']
    // });
    // $('#file-es').fileinput({
    //     theme: 'fa',
    //     language: 'es',
    //     uploadUrl: '#',
    //     allowedFileExtensions: ['jpg', 'png', 'gif']
    // });
    $("#input-b3").fileinput({
        theme: 'fa',
        language: 'zh',
        'allowedFileExtensions': ['jpg', 'png', 'gif']
    });
    // $("#file-1").fileinput({
    //     theme: 'fa',
    //     uploadUrl: '#', // you must set a valid URL here else you will get an error
    //     allowedFileExtensions: ['jpg', 'png', 'gif'],
    //     overwriteInitial: false,
    //     maxFileSize: 1000,
    //     maxFilesNum: 10,
    //     //allowedFileTypes: ['image', 'video', 'flash'],
    //     slugCallback: function (filename) {
    //         return filename.replace('(', '_').replace(']', '_');
    //     }
    // });
    /*
     $(".file").on('fileselect', function(event, n, l) {
     alert('File Selected. Name: ' + l + ', Num: ' + n);
     });
     */
    // $("#file-3").fileinput({
    //     theme: 'fa',
    //     showUpload: false,
    //     showCaption: false,
    //     browseClass: "btn btn-primary btn-lg",
    //     fileType: "any",
    //     previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    //     overwriteInitial: false,
    //     initialPreviewAsData: true,
    //     initialPreview: [
    //         "http://lorempixel.com/1920/1080/transport/1",
    //         "http://lorempixel.com/1920/1080/transport/2",
    //         "http://lorempixel.com/1920/1080/transport/3"
    //     ],
    //     initialPreviewConfig: [
    //         {caption: "transport-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
    //         {caption: "transport-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
    //         {caption: "transport-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
    //     ]
    // });
    // $("#file-4").fileinput({
    //     theme: 'fa',
    //     uploadExtraData: {kvId: '10'}
    // });
    // $(".btn-warning").on('click', function () {
    //     var $el = $("#file-4");
    //     if ($el.attr('disabled')) {
    //         $el.fileinput('enable');
    //     } else {
    //         $el.fileinput('disable');
    //     }
    // });
    // $(".btn-info").on('click', function () {
    //     $("#file-4").fileinput('refresh', {previewClass: 'bg-info'});
    // });
    
    //  $('#file-4').on('fileselectnone', function() {
    //  alert('Huh! You selected no files.');
    //  });
    //  $('#file-4').on('filebrowse', function() {
    //  alert('File browse clicked for #file-4');
    //  });
     
    // $(document).ready(function () {
    //     // $("#test-upload").fileinput({
    //     //     'theme': 'fa',
    //     //     'showPreview': false,
    //     //     'allowedFileExtensions': ['jpg', 'png', 'gif'],
    //     //     'elErrorContainer': '#errorBlock'
    //     // });
    //     $("#kv-explorer").fileinput({
    //         'theme': 'explorer-fa',
    //         'uploadUrl': '#',
    //         overwriteInitial: false,
    //         initialPreviewAsData: true,
    //         initialPreview: [
    //             "http://lorempixel.com/1920/1080/nature/1",
    //             "http://lorempixel.com/1920/1080/nature/2",
    //             "http://lorempixel.com/1920/1080/nature/3"
    //         ],
    //         initialPreviewConfig: [
    //             {caption: "nature-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
    //             {caption: "nature-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
    //             {caption: "nature-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
    //         ]
    //     });
    //     /*
    //      $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
    //      alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
    //      });
    //      */
    // });
    $(document).ready( function(){
        $(".fileinput-cancel-button").hide()
        // $(".file-preview").css({"width":"44%","left": "14%","margin-top": "20px"})
        // $(".file-caption").css({"width": "539px","left":"15%"})
        // $(".btn-file").css({"height": "34px","width": "110px","float": "right"})
        // $(".hidden-xs").css()

    });
</script>

@endsection

@section('scripts')

@include('backend::common._upload_image_scripts',['elem' => '#avatar', 'previewElem' => '#image_avatar', 'fieldElem' => '#form_avatar', 'folder'=>'avatar', 'object_id' => Auth::User()->id ])

@endsection