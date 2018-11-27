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

use App\Models\Content\Bcontact;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\BcontactRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

/**
 * 页面控制器
 *
 * Class BcontactController
 * @package App\Http\Controllers\Content
 */
class BcontactController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'busine.contact';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Bcontact $bcontact ,Request $request)
    {

        $this->authorize('index', $bcontact);
        if (!empty($serach = $request->get('contact_name'))) {
            $lists = Bcontact::where('contact_name', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = Bcontact::paginate(config('administrator.paginate.limit'));
        }
        return backend_view('bcontact.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Bcontact $bcontact)
    {
        $lists = Bcontact::all();
         return backend_view('bcontact.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Bcontact $bcontact)
    {

        $this->authorize('create', $bcontact);

        return backend_view('bcontact.create', compact('bcontact'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( BcontactRequest $request,Bcontact $bcontact)
    {
        
        $this->authorize('create', $bcontact);
        $data = $request->only('contact_name','contact_people','contact_tel','contact_release_time','contact_qq','contact_email');

        $data['contact_create_time']  = date("Y-m-d H:i:s",time());
        $data['contact_update_time']  = date("Y-m-d H:i:s",time());
        $data['contact_operate_user'] =Auth::user()->name;
        $bcontact = Bcontact::create($data);
        return $this->redirect('bcontact.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Bcontact $bcontact)
    {

        $this->authorize('update', $bcontact);
        return backend_view('bcontact.create', compact('bcontact'));
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BcontactRequest $request, Bcontact $bcontact)
    {
        $data = $request->only('contact_name','contact_people','contact_tel','contact_release_time','contact_qq','contact_email');
        
        $data['contact_update_time']  = date("Y-m-d H:i:s",time());
        $data['contact_operate_user'] =Auth::user()->name;
        $this->authorize('update', $bcontact);

        $bcontact->update($data);

        return $this->redirect('bcontact.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Bcontact $bcontact)
    {
        $this->authorize('destroy', $bcontact);
        $bcontact->delete();

        return $this->redirect()->with('success', '删除成功.');
    }

}