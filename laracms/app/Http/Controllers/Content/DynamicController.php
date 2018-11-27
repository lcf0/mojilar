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

use App\Models\Content\Dynamic;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\DynamicRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

/**
 * 页面控制器
 *
 * Class dynamicController
 * @package App\Http\Controllers\Administrator
 */
class DynamicController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.dynamic.list';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Dynamic $dynamic ,Request $request)
    {
       
        if (!empty($serach = $request->get('dynamic_title'))) {
            $lists = Dynamic::where('dynamic_title', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = Dynamic::paginate(config('administrator.paginate.limit'));
        }
        $this->authorize('index', $dynamic);
        // echo "string";die;
        // $lists =  $dynamic->filterWith()->ordered()->recent()->paginate(config('administrator.paginate.limit'));
        
        return backend_view('dynamic.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Dynamic $dynamic)
    {
        $lists = Dynamic::all();
         return backend_view('dynamic.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Dynamic $dynamic)
    {
        $this->authorize('create', $dynamic);

        return backend_view('dynamic.create', compact('dynamic'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( DynamicRequest $request,Dynamic $dynamic)
    {
        
        $this->authorize('create', $dynamic);
        $data = $request->only('dynamic_title','dynamic_content','dynamic_link','dynamic_release_time','dynamic_img_path');
       
        if (isset($data['dynamic_img_path'])) {
           $data['dynamic_img_path'] = $this->upload($request->file('dynamic_img_path'));
        }
        $data['dynamic_create_time'] = date("Y-m-d H:i:s",time());
        $data['dynamic_update_time'] = date("Y-m-d H:i:s",time());
        $data['dynamic_operate_user'] =Auth::user()->name;
        //  echo "<pre>";
        // print_r($data);die();
        $dynamic = dynamic::create($data);
        return $this->redirect('dynamic.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Dynamic $dynamic)
    {

        $this->authorize('update', $dynamic);
        return backend_view('dynamic.create', compact('dynamic'));
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(DynamicRequest $request, Dynamic $dynamic)
    {
        $data = $request->only('dynamic_title','dynamic_content','dynamic_link','dynamic_release_time','dynamic_img_path');
        if (isset($data['dynamic_img_path'])) {
           $data['dynamic_img_path'] = $this->upload($request->file('dynamic_img_path'));
        }
        $data['dynamic_update_time'] = date("Y-m-d H:i:s",time());
        $data['dynamic_operate_user'] =Auth::user()->name;
        $this->authorize('update', $dynamic);

        $dynamic->update($data);

        return $this->redirect('dynamic.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Dynamic $dynamic)
    {
        $this->authorize('destroy', $dynamic);
        $dynamic->delete();

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