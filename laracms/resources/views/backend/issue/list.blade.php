
@extends('backend::layouts.app')

@section('title', $title = '介绍列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">发版管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

<section class="content">
     <div class="row page-title-row" id="dangqian" style="margin-top: 43px;margin-bottom: 22px;">
        <form id="form-validator" class="form-horizontal" method="get" action="{{ route('issue.index') }}"
                        enctype="multipart/form-data">
        <div class="col-md-6">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">搜索平台名称</div>
                        <input type="text" class="form-control" name="issue_terrace_name" placeholder="输入平台名称" style="width: 200px;" value="{{ $serach }}"><button type="submit" class="btn btn-primary">搜索</button>
                    </div>
                
        </div>
        </form>
        <div class="col-md-6 text-right">
                <a href="issue/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加发版信息 </a>
        </div> 

         
</div>
   
<table  class="table table-bordered table-striped  table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>版本类型</th>
          <th>平台名称</th>
          <th>版本号</th>
          <th>发布日期</th>
          <th>下载地址</th>
          <th>添加时间</th>
          <th>更新时间</th>
          <th>操作人</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody id="list">
          @foreach($lists as  $list)
        <tr class="">
            <th scope="row">{{ $list->issue_id  }}</th>
            <td >{{ $list->issue_type  }}</td>
            <td >{{ $list->issue_terrace_name  }}</td>
            <td >{{ $list->issue_num  }}</td>
            <td >{{ $list->issue_release_time  }}</td>
            <td >{{ $list->issue_link  }}</td>
            <td>{{ $list->issue_create_time  }}</td>
            <td>{{ $list->issue_update_time  }}</td>
            <td>{{ $list->issue_operate_user  }}</td>
            <td>
                <a href="{{ route('issue.edit', $list->issue_id) }}" class="btn btn-xs btn-primary">
                    编辑
                </a>
                <a href="javascript:;" data-url="{{ route('issue.destroy', $list->issue_id) }}" class="btn btn-xs btn-danger form-delete">
                    删除
                </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
<script type="text/javascript">
    
</script>
{{ $lists->appends(['issue_terrace_name' => "$serach"])->links() }}
  
</section>
<!-- <script src="{{asset('js/issue/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
