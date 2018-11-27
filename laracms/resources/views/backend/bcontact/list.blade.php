
@extends('backend::layouts.app')

@section('title', $title = '介绍列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">合作</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

<section class="content">
     <div class="row page-title-row" id="dangqian" style="margin-top: 43px;margin-bottom: 22px;">
        <form id="form-validator" class="form-horizontal" method="get" action="{{ route('bcontact.index') }}"
                        enctype="multipart/form-data">
        <div class="col-md-6">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">搜索合作名称</div>
                        <input type="text" class="form-control" name="contact_name" placeholder="输入合作名称" style="width: 200px;" value="{{ $serach }}"><button type="submit" class="btn btn-primary">搜索</button>
                    </div>
                
        </div>
        </form>
        <div class="col-md-6 text-right">
                <a href="bcontact/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加商务合作名称 </a>
        </div> 

         
</div>
   
<table  class="table table-bordered table-striped  table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>合作名称</th>
          <th>联系人</th>
          <th>联系电话</th>
          <th>QQ</th>
          <th>邮箱</th>
          <th>操作人</th>
          <th>发布时间</th>
          <th>添加时间</th>
          <th>更新时间</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody id="list">
          @foreach($lists as  $list)
        <tr class="">
            <th scope="row">{{ $list->contact_id  }}</th>
            <td>{{ $list->contact_name  }}</td>
            <td>{{ $list->contact_people  }}</td>
            <td>{{ $list->contact_tel  }}</td>
            <td>{{ $list->contact_qq  }}</td>
            <td>{{ $list->contact_email   }}</td>
            <td>{{ $list->contact_operate_user  }}</td>
            <td>{{ $list->contact_release_time  }}</td>
            <td>{{ $list->contact_create_time  }}</td>
            <td>{{ $list->contact_update_time  }}</td>
            <td>
                <a href="{{ route('bcontact.edit', $list->contact_id) }}" class="btn btn-xs btn-primary">
                    编辑
                </a>
                <a href="javascript:;" data-url="{{ route('bcontact.destroy', $list->contact_id) }}" class="btn btn-xs btn-danger form-delete">
                    删除
                </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
<script type="text/javascript">
    
</script>
{{ $lists->appends(['contact_name' => "$serach"])->links() }}
  
</section>
<!-- <script src="{{asset('js/contact/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
