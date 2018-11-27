<?php
/**
 * 墨迹天气 - CMS based on laravel
 *
 * @category  墨迹天气
 * @package   Laravel
 * @author    chaofei.li@moji.com
 * @copyright Copyright 2018 墨迹天气
 * @version   Release 1.0
 */

namespace App\Http\Controllers\Content;

use App\Models\Content\Info;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\InfoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

/**
 * 页面控制器
 *
 * Class InfoController
 * @package App\Http\Controllers\Administrator
 */
class InfoController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.info';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Info $info ,Request $request)
    {
       
        if (!empty($serach = $request->get('info_title'))) {
            $lists = Info::where('info_title', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists  = Info::paginate(config('administrator.paginate.limit'));
        }
        $this->authorize('index', $info);
        // echo "string";die;
        // $lists =  $info->filterWith()->ordered()->recent()->paginate(config('administrator.paginate.limit'));
        
        return backend_view('info.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Info $info)
    {
        $lists = Info::all();
         return backend_view('info.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Info $info)
    {
        $this->authorize('create', $info);

        return backend_view('info.create', compact('info'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( InfoRequest $request,Info $info)
    {
        
        $this->authorize('create', $info);
        $data                      = $request->only('info_title','info_focus','info_content','info_release_time','info_link');
        $data['info_create_time']  = date("Y-m-d H:i:s",time());
        $data['info_update_time']  = date("Y-m-d H:i:s",time());
        $data['info_operate_user'] = Auth::user()->name;
        //  echo "<pre>";
        // print_r($data);die();
        $info = Info::create($data);
        return $this->redirect('info.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Info $info)
    {

        $this->authorize('update', $info);
        return backend_view('info.create', compact('info'));
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(InfoRequest $request, Info $info)
    {
        $data                      = $request->only('info_title','info_focus','info_content','info_release_time','info_link');
        $data['info_update_time']  = date("Y-m-d H:i:s",time());
        $data['info_operate_user'] = Auth::user()->name;
        $this->authorize('update', $info);

        $info->update($data);

        return $this->redirect('info.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Info $info)
    {
        $this->authorize('destroy', $info);
        $info->delete();

        return $this->redirect()->with('success', '删除成功.');
    }


}