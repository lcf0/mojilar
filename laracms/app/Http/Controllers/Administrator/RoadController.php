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

use App\Models\Content\Road;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Administrator\RoadRequest;
use Illuminate\Support\Facades\Storage;

/**
 * 页面控制器
 *
 * Class roadController
 * @package App\Http\Controllers\Administrator
 */
class RoadController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.road.list';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Road $road ,Request $request)
    {
        // echo "string";die;
        // print_r($request->all());die;
        $this->authorize('index', $road);
        $lists = Road::all();
        return backend_view('road.list')->with('lists' , $lists);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Road $road)
    {
        $lists = Road::all();
         return backend_view('road.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Road $road)
    {
        $this->authorize('create', $road);
        // echo "string";die;
        return backend_view('road.create', compact('road'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( RoadRequest $request,Road $road)
    {
        
        $this->authorize('create', $road);
        $data = $request->only('road_name','road_ishow','road_content','road_release_time','road_img_path');
        // echo "<pre>";
        // print_r($data);die();
        if (isset($data['road_img_path'])) {
           $data['road_img_path'] = $this->upload($request->file('road_img_path'));
        }
        $data['road_create_time'] = date("Y-m-d H:i:s",time());
        $data['road_update_time'] = date("Y-m-d H:i:s",time());
        $data['road_operate_user'] =Auth::user()->name;
        // echo "<pre>";
        // print_r($data);die;
        $road = Road::create($data);
        return $this->redirect('road.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Road $road)
    {

        $this->authorize('update', $road);
        return backend_view('road.create', compact('road'));
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(RoadRequest $request, Road $road)
    {
        $data = $request->only('road_name','road_ishow','road_content','road_release_time','road_img_path');
        if (isset($data['road_img_path'])) {
           $data['road_img_path'] = $this->upload($request->file('road_img_path'));
        }
        $data['road_update_time'] = date("Y-m-d H:i:s",time());
        $data['road_operate_user'] =Auth::user()->name;
        $this->authorize('update', $road);

        $road->update($data);

        return $this->redirect('road.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Road $road)
    {
        $this->authorize('destroy', $road);
        $road->delete();

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