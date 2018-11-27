
@extends('backend::layouts.app')

@section('title', $title = '介绍列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">品牌案例</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

<section class="content">
     <div class="row page-title-row" id="dangqian" style="margin-top: 43px;margin-bottom: 22px;">
        <form id="form-validator" class="form-horizontal" method="get" action="{{ route('brand.index') }}"
                        enctype="multipart/form-data">
        <div class="col-md-6">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">搜索品牌案例名称</div>
                        <input type="text" class="form-control" name="brand_title" placeholder="输入品牌案例名称" style="width: 200px;" value="{{ $serach }}"><button type="submit" class="btn btn-primary">搜索</button>
                    </div>
                
        </div>
        </form>
        <div class="col-md-6 text-right">
                <a href="brand/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加品牌案例 </a>
        </div> 

         
</div>
   
<table  class="table table-bordered table-striped  table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>品牌案例名称</th>
          <th>类型</th>
          <th>上线时间段</th>
          <th>操作人</th>
          <th>发布时间</th>
          <th>添加时间</th>
          <th>修改时间</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody id="list">
          @foreach($lists as  $list)
        <tr class="">
            <th scope="row">{{ $list->brand_id  }}</th>
            <td>{{ $list->brand_name  }}</td>
            <td>{{ $list->brand_type  }}</td>
            <td>{{ $list->brand_online_time  }}</td>
            <td>{{ $list->brand_operate_user  }}</td>
            <td>{{ $list->brand_release_time  }}</td>
            <td>{{ $list->brand_create_time  }}</td>
            <td>{{ $list->brand_update_time  }}</td>
            <td>
                <a href="{{ route('brand.edit', $list->brand_id) }}" class="btn btn-xs btn-primary">
                    编辑
                </a>
                <a href="javascript:;" data-url="{{ route('brand.destroy', $list->brand_id) }}" class="btn btn-xs btn-danger form-delete">
                    删除
                </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
<script type="text/javascript">
    
</script>
{{ $lists->appends(['brand_name' => "$serach"])->links() }}
  
</section>
<!-- <script src="{{asset('js/brand/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
