
@extends('backend::layouts.app')

@section('title', $title = '介绍列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">视频列表</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

<section class="content">
     <div class="row page-title-row" id="dangqian" style="margin-top: 43px;margin-bottom: 22px;">
        <form id="form-validator" class="form-horizontal" method="get" action="{{ route('video.index') }}"
                        enctype="multipart/form-data">
        <div class="col-md-6">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">搜索视频名称</div>
                        <input type="text" class="form-control" name="video_name" placeholder="输入视频名称" style="width: 200px;" value="{{ $serach }}"><button type="submit" class="btn btn-primary">搜索</button>
                    </div>
                
        </div>
        </form>
        <div class="col-md-6 text-right">
                <a href="video/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加首页视频 </a>
        </div> 

         
</div>
   
<table  style="table-layout:fixed;word-break: break-all;"  class="table table-bordered table-striped  table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>视频名称</th>
          <th>ogg视频地址</th>
          <th>webm视频地址</th>
          <th>MP4格式视频地址</th>
          <th>mov视频地址</th>
          <th>发布日期</th>
          <th>添加时间</th>
          <th>更新时间</th>
          <th>操作人</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody id="list">
          @foreach($lists as  $list)
        <tr class="">
            <th scope="row">{{ $list->video_id  }}</th>
            <td >{{ $list->video_name  }}</td>
            <td >{{ $list->video_ogg  }}</td>
            <td >{{ $list->video_webm  }}</td>
            <td >{{ $list->video_mp4  }}</td>
            <td >{{ $list->video_mov  }}</td>
            <td >{{ $list->video_release_time  }}</td>
            <td>{{ $list->video_create_time  }}</td>
            <td>{{ $list->video_update_time  }}</td>
            <td>{{ $list->video_operate_user  }}</td>
            <td>
                <a href="{{ route('video.edit', $list->video_id) }}" class="btn btn-xs btn-primary">
                    编辑
                </a>
                <a href="javascript:;" data-url="{{ route('video.destroy', $list->video_id) }}" class="btn btn-xs btn-danger form-delete">
                    删除
                </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
<script type="text/javascript">
    
</script>
{{ $lists->appends(['video_name' => "$serach"])->links() }}
  
</section>
<!-- <script src="{{asset('js/video/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
