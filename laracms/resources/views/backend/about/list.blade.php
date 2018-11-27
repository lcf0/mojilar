
@extends('backend::layouts.app')

@section('title', $title = '介绍列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">关于墨迹</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

<section class="content">
     <div class="row page-title-row" id="dangqian" style="margin-top: 43px;margin-bottom: 22px;">
        <div class="col-md-6">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">搜索标题</div>
                        <input type="text" class="form-control" id="exampleInputAmount" placeholder="输入标题" style="width: 200px;"><button type="button" class="btn btn-primary">搜索</button>
                    </div>
                
        </div>

        <div class="col-md-6 text-right">
                <a href="about/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加介绍 </a>
        </div> 

         
</div>
   
<table  class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>标题</th>
          <th>类型</th>
          <th>发布时间</th>
          <th>添加时间</th>
          <th>更新时间</th>
          <th>操作人</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody id="list">
          @foreach($lists as  $list)
        <tr class="">
            <th scope="row">{{ $list->about_id  }}</th>
            <td>{{ $list->about_title  }}</td>
            <td>{{ $list->about_type  }}</td>
            <td>{{ $list->about_release_time  }}</td>
            <td>{{ $list->about_create_time  }}</td>
            <td>{{ $list->about_update_time  }}</td>
            <td>{{ $list->about_operate_user  }}</td>
            <td>
                <a href="{{ route('about.edit', $list->about_id) }}" class="btn btn-xs btn-primary">
                    编辑
                </a>
                <a href="javascript:;" data-url="{{ route('about.destroy', $list->about_id) }}" class="btn btn-xs btn-danger form-delete">
                    删除
                </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>


  
</section>
<!-- <script src="{{asset('js/about/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
