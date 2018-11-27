
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
    <link type="text/css" href="{{asset('css/permissions/load.css')}}" rel="stylesheet">
<section class="content">

            
    <div class="row page-title-row" id="dangqian" style="margin:5px;">
        <div class="col-md-6">
                            <span style="margin:3px;" id="cid" attr="0" class="btn-flat text-info"> 顶级菜单</span>
                    </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('permissions.create') }}" class="btn btn-success btn-md"><i class="icon-plus-sign"></i> 添加权限 </a>
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
                            <select name="tags-table_length" aria-controls="tags-table" class="form-control input-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> 项结果
                        </label>
                    </div>
                </div>
                <div class="col-sm-6"><div id="tags-table_filter" class="dataTables_filter">
                    <label>搜索:
                        <input class="form-control input-sm" placeholder="" aria-controls="tags-table" type="search">
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
                    <th class="hidden-sm sorting" tabindex="0" aria-controls="tags-table" rowspan="1" colspan="1" style="width: 208px;" aria-label="权限规则: 以升序排列此列">权限规则
                    </th>
                    <th class="hidden-sm sorting" tabindex="0" aria-controls="tags-table" rowspan="1" colspan="1" style="width: 152px;" aria-label="权限名称: 以升序排列此列">权限名称
                    </th>
                    <th class="hidden-sm sorting" tabindex="0" aria-controls="tags-table" rowspan="1" colspan="1" style="width: 152px;" aria-label="权限概述: 以升序排列此列">权限概述
                    </th>
                    <th class="hidden-md sorting" tabindex="0" aria-controls="tags-table" rowspan="1" colspan="1" style="width: 228px;" aria-label="权限创建日期: 以升序排列此列">权限创建日期
                    </th>
                    <th class="hidden-md sorting_asc" tabindex="0" aria-controls="tags-table" rowspan="1" colspan="1" style="width: 228px;" aria-sort="ascending" aria-label="权限修改日期: 以降序排列此列">权限修改日期
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
                        <a style="margin:3px;" href="{{ route('permissions.subordinate', $permission->id) }}" class="X-Small btn-xs text-success ">
                            <i class="fa fa-adn"></i>下级菜单
                        </a>
                        <a style="margin:3px;" href="{{ route('permissions.edit', $permission->id) }}" class="X-Small btn-xs text-success ">
                            <i class="fa fa-edit"></i> 编辑
                        </a>
                                
                        <a style="margin:3px;" href="#" attr="1" class="delBtn X-Small btn-xs text-danger">
                            <i class="fa fa-times-circle"></i> 删除
                        </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <div class="dataTables_info" id="tags-table_info" role="status" aria-live="polite">显示第 {{$permissions->firstItem()}} 至  {{$permissions->lastItem()}}项结果，共 {{$permissions->count()}} 项
            </div>
        <div id="paginate-render">
            {{$permissions->links()}}
        </div>
    </div>
</div>

    </div>
</div>
</div>
</section>

@endsection

@section('scripts')
@endsection
