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

use App\Models\Content\Problem;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\ProblemRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Handlers\LarDebugHandler as Logger;
/**
 * 页面控制器
 *
 * Class ProblemController
 * @package App\Http\Controllers\Administrator
 */
class ProblemController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.problem';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Problem $problem ,Request $request)
    {
       Logger::log('测试');
        if (!empty($serach = $request->get('problem_ask'))) {
            $lists = Problem::where('problem_ask', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = Problem::paginate(config('administrator.paginate.limit'));
        }
        $this->authorize('index', $problem);
        // echo "string";die;
        // $lists =  $problem->filterWith()->ordered()->recent()->paginate(config('administrator.paginate.limit'));
        
        return backend_view('problem.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Problem $problem)
    {
        $lists = Problem::all();
         return backend_view('problem.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Problem $problem)
    {
        $this->authorize('create', $problem);

        return backend_view('problem.create', compact('problem'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( ProblemRequest $request,Problem $problem)
    {
        
        $this->authorize('create', $problem);
        $data = $request->only('problem_type','problem_ask','problem_answer','problem_release_time');
       
        $data['problem_create_time'] = date("Y-m-d H:i:s",time());
        $data['problem_update_time'] = date("Y-m-d H:i:s",time());
        $data['problem_operate_user'] =Auth::user()->name;
        //  echo "<pre>";
        // print_r($data);die();
        $problem = Problem::create($data);
        return $this->redirect('problem.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Problem $problem)
    {
        $img_path = config('administrator.img_path');
        $this->authorize('update', $problem);
        return backend_view('problem.create', compact('problem'))->with('img_path',$img_path);
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ProblemRequest $request, Problem $problem)
    {
        $data = $request->only('problem_type','problem_ask','problem_answer','problem_release_time');
        $data['problem_update_time'] = date("Y-m-d H:i:s",time());
        $data['problem_operate_user'] =Auth::user()->name;
        $this->authorize('update', $problem);

        $problem->update($data);

        return $this->redirect('problem.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Problem $problem)
    {
        $this->authorize('destroy', $problem);
        $problem->delete();

        return $this->redirect()->with('success', '删除成功.');
    }

}