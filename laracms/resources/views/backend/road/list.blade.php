
@extends('backend::layouts.app')

@section('title', $title = '介绍列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">墨迹之路</a></li>
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
                <a href="road/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加墨迹之路 </a>
        </div> 

         
</div>
   
<table  class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>标题</th>
          <th>操作人</th>
          <th>发布时间</th>
          <th>添加时间</th>
          <th>更新时间</th>
          <th>是否显示</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody id="list">
          @foreach($lists as  $list)
        <tr class="">
            <th scope="row">{{ $list->road_id  }}</th>
            <td>{{ $list->road_name  }}</td>
            <td>{{ $list->road_operate_user  }}</td>
            <td>{{ $list->road_release_time  }}</td>
            <td>{{ $list->road_create_time  }}</td>
            <td>{{ $list->road_update_time  }}</td>
            <td>
              <?php if ($list->road_ishow): ?>
                <?php echo '显示'; ?>
              <?php else: ?>
              <?php echo '隐藏'; ?>
                
              <?php endif ?>
              
            </td>
            <td>
                <a href="{{ route('road.edit', $list->road_id) }}" class="btn btn-xs btn-primary">
                    编辑
                </a>
                <a href="javascript:;" data-url="{{ route('road.destroy', $list->road_id) }}" class="btn btn-xs btn-danger form-delete">
                    删除
                </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>


  
</section>
<!-- <script src="{{asset('js/road/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
