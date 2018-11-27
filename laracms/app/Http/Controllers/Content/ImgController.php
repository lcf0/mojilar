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

use App\Models\Content\Img;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\ImgRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

/**
 * 页面控制器
 *
 * Class ImgController
 * @package App\Http\Controllers\Administrator
 */
class ImgController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.img';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Img $img ,Request $request)
    {
       
        if (!empty($serach = $request->get('img_title'))) {
            $lists = Img::where('img_title', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = Img::paginate(config('administrator.paginate.limit'));
        }
        $this->authorize('index', $img);
        // echo "string";die;
        // $lists =  $img->filterWith()->ordered()->recent()->paginate(config('administrator.paginate.limit'));
        
        return backend_view('img.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Img $img)
    {
        $lists = Img::all();
         return backend_view('img.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Img $img)
    {
        $this->authorize('create', $img);

        return backend_view('img.create', compact('img'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( ImgRequest $request,Img $img)
    {
        
        $this->authorize('create', $img);
        
        $data                     = $request->only('img_type','img_type','img_path','img_release_time');       
        $data['img_path']         = $this->upload($request->file('img_path'));
        $data['img_create_time']  = date("Y-m-d H:i:s",time());
        $data['img_update_time']  = date("Y-m-d H:i:s",time());
        $data['img_operate_user'] = Auth::user()->name;
        //  echo "<pre>";
        // print_r($data);die();
        $img = Img::create($data);
        return $this->redirect('img.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Img $img)
    {
        $img_path = config('administrator.img_path');
        $this->authorize('update', $img);
        return backend_view('img.create', compact('img'))->with('img_path',$img_path);
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ImgRequest $request, Img $img)
    {
        $data                     = $request->only('img_type','img_path','img_release_time');
        $data['img_path']         = $this->upload($request->file('img_path'));
        $data['img_update_time']  = date("Y-m-d H:i:s",time());
        $data['img_operate_user'] = Auth::user()->name;
        $this->authorize('update', $img);

        $img->update($data);

        return $this->redirect('img.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Img $img)
    {
        $this->authorize('destroy', $img);
        $img->delete();

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