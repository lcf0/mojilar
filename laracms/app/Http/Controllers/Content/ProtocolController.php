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

use App\Models\Content\Protocol;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\ProtocolRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Handlers\LarDebugHandler as Logger;
/**
 * 页面控制器
 *
 * Class ProtocolController
 * @package App\Http\Controllers\Administrator
 */
class ProtocolController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.protocol';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Protocol $protocol ,Request $request)
    {

        $lists = Protocol::paginate(config('administrator.paginate.limit'));
        $this->authorize('index', $protocol);
        
        return backend_view('protocol.list')->with(['lists'=>$lists]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Protocol $protocol)
    {
        $lists = Protocol::all();
         return backend_view('protocol.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Protocol $protocol)
    {
        $this->authorize('create', $protocol);

        return backend_view('protocol.create', compact('protocol'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( ProtocolRequest $request,Protocol $protocol)
    {
        
        $this->authorize('create', $protocol);
        $data = $request->only('protocol_titile','protocol_content','protocol_release_time');
       
        $data['protocol_create_time'] = date("Y-m-d H:i:s",time());
        $data['protocol_update_time'] = date("Y-m-d H:i:s",time());
        $data['protocol_operate_user'] =Auth::user()->name;
        //  echo "<pre>";
        // print_r($data);die();
        $protocol = Protocol::create($data);
        return $this->redirect('protocol.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Protocol $protocol)
    {
        $img_path = config('administrator.img_path');
        $this->authorize('update', $protocol);
        return backend_view('protocol.create', compact('protocol'))->with('img_path',$img_path);
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ProtocolRequest $request, Protocol $protocol)
    {
        $data = $request->only('protocol_titile','protocol_content','protocol_release_time');
        $data['protocol_update_time'] = date("Y-m-d H:i:s",time());
        $data['protocol_operate_user'] =Auth::user()->name;
        $this->authorize('update', $protocol);

        $protocol->update($data);

        return $this->redirect('protocol.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Protocol $protocol)
    {
        $this->authorize('destroy', $protocol);
        $protocol->delete();

        return $this->redirect()->with('success', '删除成功.');
    }

}