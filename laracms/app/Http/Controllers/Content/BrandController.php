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

use App\Models\Content\Brand;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\BrandRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

/**
 * 页面控制器
 *
 * Class BrandController
 * @package App\Http\Controllers\Content
 */
class BrandController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.brand';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Brand $brand ,Request $request)
    {
       
        if (!empty($serach = $request->get('brand_name'))) {
            $lists = Brand::where('brand_name', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = Brand::paginate(config('administrator.paginate.limit'));
        }
        $this->authorize('index', $brand);
        // echo "string";die;
        // $lists =  $brand->filterWith()->ordered()->recent()->paginate(config('administrator.paginate.limit'));
        
        return backend_view('brand.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Brand $brand)
    {
        $lists = Brand::all();
         return backend_view('brand.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Brand $brand)
    {

        $this->authorize('create', $brand);

        return backend_view('brand.create', compact('brand'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( BrandRequest $request,Brand $brand)
    {
        
        $this->authorize('create', $brand);
        $data = $request->only('brand_name','brand_type','brand_content','brand_release_time','brand_online_time','brand_img1','brand_img2','brand_img3','brand_img4','brand_img5','brand_img6','brand_ishow');
        $img = array();
        $img[] = isset($data['brand_img1']) ? $data['brand_img1'] : '';
        $img[] = isset($data['brand_img2']) ? $data['brand_img2'] : '';
        $img[] = isset($data['brand_img3']) ? $data['brand_img3'] : '';
        $img[] = isset($data['brand_img4']) ? $data['brand_img4'] : '';
        $img[] = isset($data['brand_img5']) ? $data['brand_img5'] : '';
        $img[] = isset($data['brand_img6']) ? $data['brand_img6'] : '';
        $img   = array_filter($img);

        $data['brand_img']          = $this->upload($img);
        $data['brand_create_time']  = date("Y-m-d H:i:s",time());
        $data['brand_update_time']  = date("Y-m-d H:i:s",time());
        $data['brand_operate_user'] =Auth::user()->name;
        $brand = Brand::create($data);
        return $this->redirect('brand.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Brand $brand)
    {

        $this->authorize('update', $brand);
        return backend_view('brand.create', compact('brand'));
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $data = $request->only('brand_name','brand_type','brand_content','brand_release_time','brand_online_time','brand_img1','brand_img2','brand_img3','brand_img4','brand_img5','brand_img6','brand_ishow');
        $img = array();
        $img[] = isset($data['brand_img1']) ? $data['brand_img1'] : '';
        $img[] = isset($data['brand_img2']) ? $data['brand_img2'] : '';
        $img[] = isset($data['brand_img3']) ? $data['brand_img3'] : '';
        $img[] = isset($data['brand_img4']) ? $data['brand_img4'] : '';
        $img[] = isset($data['brand_img5']) ? $data['brand_img5'] : '';
        $img[] = isset($data['brand_img6']) ? $data['brand_img6'] : '';
        $img   = array_filter($img);

        $data['brand_img']          = $this->upload($img);
        $data['brand_update_time']  = date("Y-m-d H:i:s",time());
        $data['brand_operate_user'] =Auth::user()->name;
        $this->authorize('update', $brand);

        $brand->update($data);

        return $this->redirect('brand.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Brand $brand)
    {
        $this->authorize('destroy', $brand);
        $brand->delete();

        return $this->redirect()->with('success', '删除成功.');
    }

    public function upload($file = ''){
        $str = '';
        foreach ($file as $key => $value) {
            // print_r($file);die;
            $file_name = strtolower(md5($value->getClientOriginalName().Auth::user()->email));

            //获取文件的扩展名 
            $ext = $value->getClientOriginalExtension();

            //获取文件的绝对路径
            $path = $value->getRealPath();

            //定义文件名
            $filename = date("Ym").'/'.date('d').'/'.$file_name.'.'.$ext;

            Storage::disk('local')->put($filename, file_get_contents($path));
            $str.='uploads/'.$filename.',';
        }
       

        return  substr($str, 0,-1);
    }
}