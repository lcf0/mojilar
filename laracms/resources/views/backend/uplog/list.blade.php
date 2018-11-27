
@extends('backend::layouts.app')

@section('title', $title = '介绍列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">升级日志</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

<section class="content">
     <div class="row page-title-row" id="dangqian" style="margin-top: 43px;margin-bottom: 22px;">
        <form id="form-validator" class="form-horizontal" method="get" action="{{ route('uplog.index') }}"
                        enctype="multipart/form-data">
        <div class="col-md-6">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">搜索标题</div>
                        <input type="text" class="form-control" name="uplog_title" placeholder="输入标题" style="width: 200px;" value="{{ $serach }}"><button type="submit" class="btn btn-primary">搜索</button>
                    </div>
                
        </div>
        </form>
        <div class="col-md-6 text-right">
                <a href="uplog/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加升级日志 </a>
        </div> 

         
</div>
   
<table  class="table table-bordered table-striped  table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>标题</th>
          <th>下载地址</th>
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
            <th scope="row">{{ $list->uplog_id  }}</th>
            <td >{{ $list->uplog_title  }}</td>
            <td >{{ $list->uplog_down_link  }}</td>
            <td >{{ $list->uplog_release_time  }}</td>
            <td>{{ $list->uplog_create_time  }}</td>
            <td>{{ $list->uplog_update_time  }}</td>
            <td>{{ $list->uplog_operate_user  }}</td>
            <td>
                <a href="{{ route('uplog.edit', $list->uplog_id) }}" class="btn btn-xs btn-primary">
                    编辑
                </a>
                <a href="javascript:;" data-url="{{ route('uplog.destroy', $list->uplog_id) }}" class="btn btn-xs btn-danger form-delete">
                    删除
                </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
<script type="text/javascript">
    
</script>
{{ $lists->appends(['uplog_title' => "$serach"])->links() }}
  
</section>
<!-- <script src="{{asset('js/uplog/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
