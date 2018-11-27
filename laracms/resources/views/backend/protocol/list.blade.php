
@extends('backend::layouts.app')

@section('title', $title = '介绍列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">服务协议</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

<section class="content">
     <div class="row page-title-row" id="dangqian" style="margin-top: 43px;margin-bottom: 22px;">
        <div class="col-md-6 text-left">
                <a href="protocol/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加服务协议 </a>
        </div> 

         
</div>
   
<table  class="table table-bordered table-striped  table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>协议标题</th>
          <th>发布日期</th>
          <th>操作人</th>
          <th>添加时间</th>
          <th>更新时间</th>

          <th>操作</th>
        </tr>
      </thead>
      <tbody id="list">
          @foreach($lists as  $list)
        <tr class="">
            <th scope="row">{{ $list->protocol_id  }}</th>
            <td >{{ $list->protocol_titile  }}</td>
            <td>{{ $list->protocol_operate_user  }}</td>
            <td >{{ $list->protocol_release_time  }}</td>
            <td>{{ $list->protocol_create_time  }}</td>
            <td>{{ $list->protocol_update_time  }}</td>
            <td>
                <a href="{{ route('protocol.edit', $list->protocol_id) }}" class="btn btn-xs btn-primary">
                    编辑
                </a>
                <a href="javascript:;" data-url="{{ route('protocol.destroy', $list->protocol_id) }}" class="btn btn-xs btn-danger form-delete">
                    删除
                </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
<script type="text/javascript">
    
</script>
{{ $lists->appends(['protocol_terrace_name' => ""])->links() }}
  
</section>
<!-- <script src="{{asset('js/protocol/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
