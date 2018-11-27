
@extends('backend::layouts.app')

@section('title', $title = '介绍列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">图片管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

<section class="content">
     <div class="row page-title-row" id="dangqian" style="margin-top: 43px;margin-bottom: 22px;">
        <form id="form-validator" class="form-horizontal" method="get" action="{{ route('img.index') }}"
                        enctype="multipart/form-data">
        <div class="col-md-6">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">搜索图片类型</div>
                        <input type="text" class="form-control" name="img_type" placeholder="输入图片类型" style="width: 200px;" value="{{ $serach }}"><button type="submit" class="btn btn-primary">搜索</button>
                    </div>
                
        </div>
        </form>
        <div class="col-md-6 text-right">
                <a href="img/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加图片 </a>
        </div> 

         
</div>
   
<table  class="table table-bordered table-striped  table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>图片类型</th>
          <th>图片地址</th>
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
            <th scope="row">{{ $list->img_id  }}</th>
            <td >{{ $list->img_type  }}</td>
            <td >{{ $list->img_path  }}</td>
            <td >{{ $list->img_release_time  }}</td>
            <td>{{ $list->img_create_time  }}</td>
            <td>{{ $list->img_update_time  }}</td>
            <td>{{ $list->img_operate_user  }}</td>
            <td>
                <a href="{{ route('img.edit', $list->img_id) }}" class="btn btn-xs btn-primary">
                    编辑
                </a>
                <a href="javascript:;" data-url="{{ route('img.destroy', $list->img_id) }}" class="btn btn-xs btn-danger form-delete">
                    删除
                </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
<script type="text/javascript">
    
</script>
{{ $lists->appends(['img_type' => "$serach"])->links() }}
  
</section>
<!-- <script src="{{asset('js/img/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
