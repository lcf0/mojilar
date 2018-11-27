@extends('backend::layouts.app')

@section('title', $title = '友情链接列表')

@section('breadcrumb')
    <li><a href="javascript:;">站点设置</a></li>
    <li><a href="javascript:;">友情链接</a></li>
    <li>{{$title}}</li>
@endsection

@section('content')

    <h2 class="header-dividing">{{$title}} <small></small></h2>
    <div class="row">
        <div class="col-md-12">

            <div class="table-tools" style="margin-bottom: 15px;">
                <div class="pull-right" style="width: 250px;">
                </div>
                <div class="tools-group">
                    <a href="{{ route('links.create') }}" class="btn btn-primary"><i class="icon icon-plus-sign"></i> 添加</a>
                </div>
            </div>

            @if($links->count())
                <table style="table-layout:fixed;word-break: break-all;"  class="table table-bordered table-striped  table-hover">
                    <colgroup>
                       
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
                    <tbody>
                    @foreach($links as $index => $link)
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
                            <td >{{ $link->operate_at}}</td>
                            <td >
                                <a href="{{ route('links.edit', $link->id) }}" class="btn btn-xs btn-primary">编辑</a>
                                <a href="javascript:;" data-url="{{ route('links.destroy', $link->id) }}" class="btn btn-xs btn-danger form-delete">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            <div id="paginate-render">
                {{$links->links()}}
            </div>
            @else
            <div class="alert alert-info alert-block">暂无数据</div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')

@endsection