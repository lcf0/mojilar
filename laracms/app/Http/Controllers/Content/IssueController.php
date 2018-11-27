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

use App\Models\Content\Issue;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\IssueRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

/**
 * 页面控制器
 *
 * Class issueController
 * @package App\Http\Controllers\Administrator
 */
class IssueController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.issue';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Issue $issue ,Request $request)
    {
       
        if (!empty($serach = $request->get('issue_terrace_name'))) {
            $lists = Issue::where('issue_terrace_name', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = Issue::paginate(config('administrator.paginate.limit'));
        }
        $this->authorize('index', $issue);
        // echo "string";die;
        // $lists =  $issue->filterWith()->ordered()->recent()->paginate(config('administrator.paginate.limit'));
        
        return backend_view('issue.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Issue $issue)
    {
        $lists = Issue::all();
         return backend_view('issue.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Issue $issue)
    {
        $this->authorize('create', $issue);

        return backend_view('issue.create', compact('issue'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( IssueRequest $request,Issue $issue)
    {
        
        $this->authorize('create', $issue);
        $data = $request->only('issue_type','issue_terrace_name','issue_num','issue_release_time','issue_link');
       
        if (isset($data['issue_img'])) {
           $data['issue_img'] = $this->upload($request->file('issue_img'));
        }
        $data['issue_create_time'] = date("Y-m-d H:i:s",time());
        $data['issue_update_time'] = date("Y-m-d H:i:s",time());
        $data['issue_operate_user'] =Auth::user()->name;
        //  echo "<pre>";
        // print_r($data);die();
        $issue = Issue::create($data);
        return $this->redirect('issue.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Issue $issue)
    {

        $this->authorize('update', $issue);
        return backend_view('issue.create', compact('issue'));
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(IssueRequest $request, Issue $issue)
    {
        $data = $request->only('issue_type','issue_terrace_name','issue_num','issue_release_time','issue_link');
        if (isset($data['issue_img'])) {
           $data['issue_img'] = $this->upload($request->file('issue_img'));
        }
        $data['issue_update_time'] = date("Y-m-d H:i:s",time());
        $data['issue_operate_user'] =Auth::user()->name;
        $this->authorize('update', $issue);

        $issue->update($data);

        return $this->redirect('issue.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Issue $issue)
    {
        $this->authorize('destroy', $issue);
        $issue->delete();

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