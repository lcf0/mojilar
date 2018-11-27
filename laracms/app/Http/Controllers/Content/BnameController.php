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

use App\Models\Content\Bname;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\BnameRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

/**
 * 页面控制器
 *
 * Class BnameController
 * @package App\Http\Controllers\Content
 */
class BnameController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'busine.name';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Bname $bname ,Request $request)
    {
       
        $this->authorize('index', $bname);
        if (!empty($serach = $request->get('bname_name'))) {
            $lists = Bname::where('bname_name', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = Bname::paginate(config('administrator.paginate.limit'));
        }
        
        return backend_view('bname.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Bname $bname)
    {
        $lists = Bname::all();
         return backend_view('bname.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Bname $bname)
    {

        $this->authorize('create', $bname);

        return backend_view('bname.create', compact('bname'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( BnameRequest $request,Bname $bname)
    {
        
        $this->authorize('create', $bname);
        $data = $request->only('bname_name','bname_content','bname_release_time');

        $data['bname_create_time']  = date("Y-m-d H:i:s",time());
        $data['bname_update_time']  = date("Y-m-d H:i:s",time());
        $data['bname_operate_user'] =Auth::user()->name;
        $bname = Bname::create($data);
        return $this->redirect('bname.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Bname $bname)
    {

        $this->authorize('update', $bname);
        return backend_view('bname.create', compact('bname'));
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BnameRequest $request, Bname $bname)
    {
        $data = $request->only('bname_name','bname_content','bname_release_time');

        $data['bname_update_time']  = date("Y-m-d H:i:s",time());
        $data['bname_operate_user'] =Auth::user()->name;
        $this->authorize('update', $bname);

        $bname->update($data);

        return $this->redirect('bname.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Bname $bname)
    {
        $this->authorize('destroy', $bname);
        $bname->delete();

        return $this->redirect()->with('success', '删除成功.');
    }
}