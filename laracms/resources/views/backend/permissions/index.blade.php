
@extends('backend::layouts.app')

@section('title', $title = '权限列表')

@section('breadcrumb')
    <li><a href="javascript:;">系统设置</a></li>
    <li><a href="javascript:;">权限管理</a></li>
    <li class="active">{{$title}}</li>
@endsection

@section('content')
     
    <link rel="stylesheet" type="text/css" href="{{asset('css/permissions/bootstrap.css')}}">
    <link type="text/css" href="{{asset('css/permissions/dataTables.css')}}" rel="stylesheet">  
    <link type="text/css" href="{{asset('css/permissions/font-awesome.css')}}" rel="stylesheet">
    <link type="text/css" href="{{asset('css/permissions/bootstrap.min.css')}}" rel="stylesheet">
<section class="content">

            
    <div class="row page-title-row" id="dangqian" style="margin:5px;">
        <div class="col-md-6">
            @if($cid==0)
                <span style="margin:3px;" id="cid" attr="{{$cid}}" class="btn-flat text-info"> 顶级菜单</span>
            @else
                <a style="margin:3px;" href="{{ route('permissions.index') }}"
                   class="btn btn-warning btn-md animation-shake reloadBtn"><i class="icon-reply"></i> 返回顶级菜单
                </a>
            @endif
        </div>

        <div class="col-md-6 text-right">
            @if($cid==0)
                <a href="{{ route('permissions.create') }}" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加权限 </a>
            @else
                <a href="{{ route('permissions.create',array('id'=>$cid)) }}" class="btn btn-success btn-md"><i class=" icon-plus-sign"></i> 添加权限 </a>
            @endif
    </div>
</div>
<div class="row page-title-row" style="margin:5px;">
<div class="col-md-6">
</div>
<div class="col-md-6 text-right">
</div>
</div>

<div class="row">
<div class="col-sm-12">
    <div class="box">
        <div id="tags-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row">
                <div class="col-sm-6">
                    <div class="dataTables_length" id="tags-table_length">
                        <label>显示 
                            <select id="selec" name="tags-table_length" aria-controls="tags-table" class="form-control input-sm">
                                <option 
                                @if($limit==15)
                                {{'selected = selected'}} 
                                @endif
                                value="15">15</option>
                                <option 
                                @if($limit==25)
                                {{'selected = selected'}} 
                                @endif
                                value="25">25</option>
                                <option 
                                @if($limit==50)
                                {{'selected = selected'}} 
                                @endif
                                value="50">50</option>
                                <option 
                                @if($limit==100)
                                {{'selected = selected'}} 
                                @endif
                                value="100">100</option>
                            </select> 项结果
                        </label>
                    </div>
                </div>
                <div class="col-sm-6"><div id="tags-table_filter" class="dataTables_filter">
                    <label>搜索:
                        <input class="form-control input-sm" id="search_input" name="s" placeholder="" aria-controls="tags-table" 
                        <?php if ($search): ?>
                            value = {{$search}}
                        <?php endif ?>
                        type="search">
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

                <table id="tags-table" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="tags-table_info" style="width: 1640px;">
                <thead>
                <tr role="row">
                    <th data-sortable="false" class="hidden-sm sorting_disabled" rowspan="1" colspan="1" style="width: 39px;" aria-label="">
                        
                    </th>
                    <th class="hidden-sm sm" tabindex="0" aria-controls="tags-table" rowspan="1" colspan="1" style="width: 208px;" aria-label="权限规则: 以升序排列此列">权限规则 <i class="icon-th" ></i>    
                    </th>
                    <th class="hidden-sm  sm" tabindex="0" aria-controls="tags-table" rowspan="1" colspan="1" style="width: 152px;" aria-label="权限名称: 以升序排列此列">权限名 <i class="icon-th" ></i>   
                    </th>
                    <th class="hidden-sm  sm" tabindex="0" aria-controls="tags-table" rowspan="1" colspan="1" style="width: 152px;" aria-label="权限概述: 以升序排列此列">权限概 <i class="icon-th" ></i>   
                    </th>
                    <th class="hidden-md sm" tabindex="0" aria-controls="tags-table" rowspan="1" colspan="1" style="width: 228px;" aria-label="权限创建日期: 以升序排列此列">权限创建日 <i class="icon-th" ></i>   
                    </th>
                    <th class="hidden-md sm" tabindex="0" aria-controls="tags-table" rowspan="1" colspan="1" style="width: 228px;" aria-sort="ascending" aria-label="权限修改日期: 以降序排列此列">权限修 <i class="icon-th" ></i> 
                    </th>
                    <th data-sortable="false" class="sorting_disabled" rowspan="1" colspan="1" style="width: 359px;" aria-label="操作">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $index => $permission)
                    <tr role="row" class="odd">
                        <td class="text-center">{{ $permission->id }}</td>
                        <td>{{ $permission->name  }}</td>
                        <td>{{ $permission->remarks  }}</td>
                        <td>{{ $permission->summary  }}</td>
                        <td>{{ $permission->created_at  }}</td>
                        <td>{{ $permission->updated_at  }}</td>
                        <td class="text-center">
                            @if($cid==0)
                                <a style="margin:3px;" href="{{ route('permissions.index', array('id'=>$permission->id)) }}" class="X-Small btn-xs text-success ">
                                    <i class="icon-eject"></i>下级菜单
                                </a>
                            @endif
                        <a style="margin:3px;" href="{{ route('permissions.edit', $permission->id) }}" class="X-Small btn-xs text-success ">
                            <i class="icon icon-edit"></i> 编辑
                        </a>
                            <a style="margin:3px;" href="#"  href="javascript:;" data-url="{{ route('permissions.destroy', $permission->id) }}" class="btn btn-xs btn-danger form-delete"><i class="icon-trash"></i>删除</a>    
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" id="cid" name="" value="{{$cid}}">
    <div class="row">
        <div class="col-sm-5">
            <div class="dataTables_info" id="tags-table_info" role="status" aria-live="polite">显示第 {{$permissions->firstItem()}} 至  {{$permissions->lastItem()}}项结果，共 {{$permissions->count()}} 项
            </div>
        <div id="paginate-render">
            <?php if ($cid !=0): ?>
                {{$permissions->appends(['id' => "$cid",'l'=>$limit,'s'=>$search])->links()}}
            <?php else: ?>
                {{$permissions->appends(['l'=>$limit,'s'=>$search])->links()}}
            <?php endif ?>

            

        </div>
    </div>
</div>

    </div>
</div>
</div>
</section>
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).on('change','#selec',function(){
        var limit = $(this).val()
        var search = $('#search_input').val();
        if (search){
            var url = '/administrator/permissions? l='+limit+'&s='+search;
        }else{
            var url = '/administrator/permissions? l='+limit
        }
        if ($("#cid").val()) {
           url = url+'& id= '+$("#cid").val()
        }
       $(location).attr('href', url);
    })
    $('#search_input').bind('keyup', function(event) {
        　　if (event.keyCode == "13") {
            var search = $(this).val();
            var url = '/administrator/permissions? s='+search;
            if ($("#cid").val()) {
                    url+= '& id= '+$("#cid").val()
                }
                $(location).attr('href', url);
                
        　　}
        });
</script>

@endsection

@section('scripts')
@endsection
