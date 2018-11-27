
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
        <form id="form-validator" class="form-horizontal" method="get" action="{{ route('links.index') }}"
                        enctype="multipart/form-data">
        <div class="col-md-6">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">搜索名称</div>
                        <input type="text" class="form-control" name="name" placeholder="输入名称" style="width: 200px;" value="{{ $serach }}"><button type="submit" class="btn btn-primary">搜索</button>
                    </div>
                
        </div>
        </form>
        <div class="col-md-6 text-right">
                <a href="links/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加友情链接 </a>
        </div> 

         
</div>
   
<table  class="table table-bordered table-striped  table-hover">
      <thead>
        <tr>
          <th >序号</th>
          <th >名称</th>
          <th >链接</th>
          <th >LOGO</th>
          <th >排序</th>
          <th >状态</th>
          <th >发布时间</th>
          <th >添加时间</th>
          <th >更新时间</th>
          <th >操作人</th>
          <th >操作</th>
        </tr>
      </thead>
      <tbody id="list">
          @foreach($lists as  $link)
        <tr>
          <td >{{ $link->id }}</td>
          <td >{{ $link->name}}</td>
          <td>{{ $link->url}}</td>
          <td >{{$img_path}}{{ $link->image }}</td>
          <td >{{ $link->order}}</td>

          <td >@switch($link->status)
                  @case(0)<span class="label label-badge label-danger">隐藏</span>@break
                  @case(1)<span class="label label-badge label-success">正常</span>@break
              @endswitch
          </td>
          <td >{{ $link->release_time}}</td>
          <td >{{ $link->created_at}}</td>
          <td >{{ $link->updated_at}}</td>
          <td >{{ $link->operate_user}}</td>
          <td >
              <a href="{{ route('links.edit', $link->id) }}" class="btn btn-xs btn-primary">编辑</a>
              <a href="javascript:;" data-url="{{ route('links.destroy', $link->id) }}" class="btn btn-xs btn-danger form-delete">删除</a>
          </td>
       </tr>
        @endforeach
      </tbody>
    </table>
<script type="text/javascript">
    
</script>
{{ $lists->appends(['name' => "$serach"])->links() }}
  
</section>
<!-- <script src="{{asset('js/link/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
