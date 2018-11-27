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

namespace App\Http\Controllers\Administrator;

use App\Models\Content\About;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Administrator\AboutRequest;
use Illuminate\Support\Facades\Storage;

/**
 * 页面控制器
 *
 * Class AboutController
 * @package App\Http\Controllers\Administrator
 */
class AboutController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.about';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(About $about ,Request $request)
    {
        // print_r($request->all());die;
        $this->authorize('index', $about);
        $lists = About::all();
        return backend_view('about.list')->with('lists' , $lists);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(About $about)
    {
        $lists = About::all();
         return backend_view('about.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(About $about)
    {
        $this->authorize('create', $about);

        return backend_view('about.create', compact('about'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( AboutRequest $request,About $about)
    {
        
        $this->authorize('create', $about);
        $data = $request->only('about_title','about_type','about_content','about_release_time','about_img_path');
        // echo "<pre>";
        // print_r($data);die();
        if (isset($data['about_img_path'])) {
           $data['about_img_path'] = $this->upload($request->file('about_img_path'));
        }
        $data['about_create_time'] = date("Y-m-d H:i:s",time());
        $data['about_update_time'] = date("Y-m-d H:i:s",time());
        $data['about_operate_user'] =Auth::user()->name;

        $about = About::create($data);
        return $this->redirect('about.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(About $about)
    {

        $this->authorize('update', $about);
        return backend_view('about.create', compact('about'));
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(AboutRequest $request, About $about)
    {
        $data = $request->only('about_title','about_type','about_content','about_release_time','about_img_path');
        if ($data['about_img_path']) {
           $data['about_img_path'] = $this->upload($request->file('about_img_path'));
        }
        $data['about_update_time'] = date("Y-m-d H:i:s",time());
        $data['about_operate_user'] =Auth::user()->name;
        $this->authorize('update', $about);

        $about->update($data);

        return $this->redirect('about.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(About $about)
    {
        $this->authorize('destroy', $about);
        $about->delete();

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