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

use App\Models\Content\Uplog;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\UplogRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

/**
 * 页面控制器
 *
 * Class UplogController
 * @package App\Http\Controllers\Administrator
 */
class UplogController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.uplog';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Uplog $uplog ,Request $request)
    {
       
        if (!empty($serach = $request->get('uplog_title'))) {
            $lists = Uplog::where('uplog_title', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = Uplog::paginate(config('administrator.paginate.limit'));
        }
        $this->authorize('index', $uplog);
        // echo "string";die;
        // $lists =  $uplog->filterWith()->ordered()->recent()->paginate(config('administrator.paginate.limit'));
        
        return backend_view('uplog.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Uplog $uplog)
    {
        $lists = Uplog::all();
         return backend_view('uplog.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Uplog $uplog)
    {
        $this->authorize('create', $uplog);

        return backend_view('uplog.create', compact('uplog'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( UplogRequest $request,Uplog $uplog)
    {
        
        $this->authorize('create', $uplog);
        $data = $request->only('uplog_title','uplog_type','uplog_down_link','uplog_content','uplog_release_time','uplog_img');
       
        if (isset($data['uplog_img'])) {
           $data['uplog_img'] = $this->upload($request->file('uplog_img'));
        }
        $data['uplog_create_time'] = date("Y-m-d H:i:s",time());
        $data['uplog_update_time'] = date("Y-m-d H:i:s",time());
        $data['uplog_operate_user'] =Auth::user()->name;
        //  echo "<pre>";
        // print_r($data);die();
        $uplog = Uplog::create($data);
        return $this->redirect('uplog.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Uplog $uplog)
    {
        $img_path = config('administrator.img_path');
        $this->authorize('update', $uplog);
        return backend_view('uplog.create', compact('uplog'))->with('img_path',$img_path);
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UplogRequest $request, Uplog $uplog)
    {
        $data = $request->only('uplog_title','uplog_type','uplog_down_link','uplog_content','uplog_release_time','uplog_img');
        // print_r($data);die;
        if (isset( $data['uplog_img'])) {
            $data['uplog_img'] = $this->upload($request->file('uplog_img'));
        }
        $data['uplog_update_time'] = date("Y-m-d H:i:s",time());
        $data['uplog_operate_user'] =Auth::user()->name;
        $this->authorize('update', $uplog);

        $uplog->update($data);

        return $this->redirect('uplog.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Uplog $uplog)
    {
        $this->authorize('destroy', $uplog);
        $uplog->delete();

        return $this->redirect()->with('success', '删除成功.');
    }

    public function upload($file = ''){
        if (!$file) {
            return false;
        }
        // print_r($file);die;
        $file_name = strtolower(md5($file->getClientOriginalName().Auth::user()->email));

        //获取文件的扩展名 
        $ext = $file->getClientOriginalExtension();

        //获取文件的绝对路径
        $path = $file->getRealPath();

        //定义文件名
        $filename = date("Ym").'/'.date('d').'/'.$file_name.'.'.$ext;

        Storage::disk('local')->put($filename, file_get_contents($path));

        return'uploads/'.$filename;
    }
}