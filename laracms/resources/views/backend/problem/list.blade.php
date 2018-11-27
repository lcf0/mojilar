
@extends('backend::layouts.app')

@section('title', $title = '介绍列表')

@section('breadcrumb')
    <li><a href="javascript:;">内容管理</a></li>
    <li><a href="javascript:;">常见问题</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')

<section class="content">
     <div class="row page-title-row" id="dangqian" style="margin-top: 43px;margin-bottom: 22px;">
        <form id="form-validator" class="form-horizontal" method="get" action="{{ route('problem.index') }}">
        <div class="col-md-6">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon">问题搜索</div>
                        <input type="text" class="form-control" name="problem_ask" placeholder="输入问题" style="width: 200px;" value="{{ $serach }}">
                       <!-- <select class="selectpicker"  name="problem_type"  >
                          <option value="">选择平台</option>
                          <option value="iPhone" >
                            iPhone
                          </option>
                          <option value="Android">
                            Android
                          </option>

                           <option value="WP8">
                            WP8
                          </option>
                        </select> -->

                        <button type="submit" class="btn btn-primary">搜索</button>
                    </div>
                
        </div>
        </form>
        <div class="col-md-6 text-right">
                <a href="problem/create" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加常见问题 </a>
        </div> 

         
</div>
   
<table style="table-layout:fixed;"  class="table table-bordered table-striped  table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>问题</th>
          <th>回答</th>
          <th>填写日期</th>
          <th>添加日期</th>
          <th>更新日期</th>
          <th>操作人</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody id="list">
          @foreach($lists as  $list)
        <tr class="">
            <th scope="row">{{ $list->problem_id  }}</th>
            <td class="text-danger">问：{{ $list->problem_ask  }}</td>
            <td class="text-success">答：{{ $list->problem_answer   }}</td>
            <td >{{ $list->problem_release_time  }}</td>
            <td>{{ $list->problem_create_time  }}</td>
            <td>{{ $list->problem_update_time  }}</td>
            <td>{{ $list->problem_operate_user  }}</td>
            <td>
              <?php if ($list->problem_ishow): ?>
                <?php echo '显示'; ?>
              <?php else: ?>
              <?php echo '隐藏'; ?>
                
              <?php endif ?>
              
            </td>
            <td>
                <a href="{{ route('problem.edit', $list->problem_id) }}" class="btn btn-xs btn-primary">
                    编辑
                </a>
                <a href="javascript:;" data-url="{{ route('problem.destroy', $list->problem_id) }}" class="btn btn-xs btn-danger form-delete">
                    删除
                </a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>

<script type="text/javascript">

    </script>
{{ $lists->appends(['problem_title' => "$serach" , 'problem_type'=>''])->links() }}
  
</section>
<!-- <script src="{{asset('js/problem/list.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
@endsection
