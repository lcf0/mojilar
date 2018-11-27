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

use App\Models\Content\Hiring;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\HiringRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

/**
 * 页面控制器
 *
 * Class hiringController
 * @package App\Http\Controllers\Administrator
 */
class HiringController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.hiring';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Hiring $hiring ,Request $request)
    {
       
        if (!empty($serach = $request->get('hiring_name'))) {
            $lists = hiring::where('hiring_name', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = hiring::paginate(config('administrator.paginate.limit'));
        }
        $this->authorize('index', $hiring);
        // echo "string";die;
        // $lists =  $hiring->filterWith()->ordered()->recent()->paginate(config('administrator.paginate.limit'));
        
        return backend_view('hiring.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Hiring $hiring)
    {
        $lists = hiring::all();
         return backend_view('hiring.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Hiring $hiring)
    {
        $this->authorize('create', $hiring);

        return backend_view('hiring.create', compact('hiring'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( HiringRequest $request,Hiring $hiring)
    {
        
        $this->authorize('create', $hiring);
        $data = $request->only('hiring_name','hiring_content','hiring_release_time','hiring_img','hiring_ishow');
       
        if (isset($data['hiring_img'])) {
           $data['hiring_img'] = $this->upload($request->file('hiring_img'));
        }
        $data['hiring_create_time'] = date("Y-m-d H:i:s",time());
        $data['hiring_update_time'] = date("Y-m-d H:i:s",time());
        $data['hiring_operate_user'] =Auth::user()->name;
        //  echo "<pre>";
        // print_r($data);die();
        $hiring = Hiring::create($data);
        return $this->redirect('hiring.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Hiring $hiring)
    {

        $this->authorize('update', $hiring);
        return backend_view('hiring.create', compact('hiring'));
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(HiringRequest $request, Hiring $hiring)
    {
        $data = $request->only('hiring_name','hiring_content','hiring_release_time','hiring_img','hiring_ishow');
        if (isset($data['hiring_img'])) {
           $data['hiring_img'] = $this->upload($request->file('hiring_img'));
        }
        $data['hiring_update_time'] = date("Y-m-d H:i:s",time());
        $data['hiring_operate_user'] =Auth::user()->name;
        $this->authorize('update', $hiring);

        $hiring->update($data);

        return $this->redirect('hiring.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Hiring $hiring)
    {
        $this->authorize('destroy', $hiring);
        $hiring->delete();

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