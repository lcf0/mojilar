<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

namespace App\Http\Controllers\Administrator;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Requests\Administrator\LinkRequest;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
/**
 * 友情链接
 *
 * Class LinksController
 * @package App\Http\Controllers\Administrator
 */
class LinksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    
        static::$activeNavId = 'website.link';
    }

    /**
     * 列表
     *
     * @param Request $request
     * @param Link $link
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function index(Request $request, Link $link)
	{
        $img_path = config('administrator.img_path');

        if (!empty($serach = $request->get('name'))) {
            $lists = Link::where('name', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = Link::paginate(config('administrator.paginate.limit'));
        }
        $this->authorize('index', $link);
        
        return backend_view('links.list')->with(['lists'=>$lists,'serach'=>$serach,'img_path'=>$img_path]);






	 //    $this->authorize('index',$link);

  //       //倒序
  //       // $links = $link->orderBy('id','desc')->ordered()->recent()->paginate((config('administrator.paginate.limit')));
  //       //正序
	 //    $links = $link->orderBy('id','asc')->ordered()->recent()->paginate((config('administrator.paginate.limit')));

		// return backend_view('links.index', compact('links'))->with('img_path' , $img_path);
	}

    /**
     * 详情
     *
     * @param Link $link
     * @return mixed
     */
    public function show(Link $link)
    {   $img_path = config('administrator.img_path');
        return backend_view('links.show', compact('link'))->with('img_path',$img_path);
    }

    /**
     * 创建
     *
     * @param Link $link
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function create(Link $link)
	{
        $this->authorize('create',$link);

        return backend_view('links.create_and_edit', compact('link'));
	}

    /**
     * 保存
     *
     * @param LinkRequest $request
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function store(LinkRequest $request, Link $link)
	{
        $this->authorize('create',$link);
        $data = $request->all();
        $data['image'] = $this->upload($request->file('image'));
        $data['operate_user'] =Auth::user()->name;
        $link = Link::create($data);

        return redirect()->route('links.index')->with('success', '添加成功.');
	}

    /**
     * 编辑
     *
     * @param Link $link
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function edit(Link $link)
	{
        $this->authorize('update', $link);
        $img_path = config('administrator.img_path');
        return backend_view('links.create_and_edit', compact('link'))->with('img_path',$img_path);
	}

    /**
     * 更新
     *
     * @param LinkRequest $request
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function update(LinkRequest $request, Link $link)
	{

		$this->authorize('update', $link);
        $data = $request->all();
        if (isset( $data['image'])) {
            $data['image'] = $this->upload($request->file('image'));
        }
        $data['operate_user'] =Auth::user()->name;
		$link->update($data);

		return $this->redirect('links.index')->with('success', '更新成功.');
	}

    /**
     * 删除
     *
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function destroy(Link $link)
	{
		$this->authorize('destroy', $link);
		$link->delete();

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