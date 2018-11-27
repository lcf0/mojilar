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

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * 权限控制器
 *
 * Class PermissionsController
 * @package App\Http\Controllers\Administrator
 */
class PermissionsController extends Controller
{
    public function __construct()
    {
        static::$activeNavId = 'system.permissions';
    }
    
    /**
     * 列表
     *
     * @param Request $request
     * @param Permission $permission
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, Permission $permission)
    {
        $this->authorize('index', $permission);
        $limit = null !==$request->get('l')?$request->get('l'):config('administrator.paginate.limit');
        $search = null !==$request->get('s')?$request->get('s'):false;
        // echo $request->get('s');die;
        $id  = null !==$request->get('id')?$request->get('id'):false;
        if ($search  && null !==$request->get('id')) {
            $permissions = $permission->where('parent_id','=',$id)->where('remarks' , 'LIKE' ,'%'.$search.'%')->paginate($limit);
        }elseif(null !==$request->get('id')){
            $permissions = $permission->where('parent_id','=',$id)->paginate($limit);
        }elseif ($search) {
            $permissions = $permission->where('grade','=','0'.'')->where('remarks' , 'LIKE' ,'%'.$search.'%')->paginate($limit);
        }else{
            // 
             $permissions = $permission->where('grade','=','0')->paginate($limit);
        }

        if ($id) {
            // $this->authorize('index', $permission);
            // $permissions = $permission->paginate($limit);
            return backend_view('permissions.index', compact('permissions'))->with(['cid'=>$id,'limit'=>$limit,'search'=>$search]);
        }else {
           
            // $permissions = $permission->paginate($limit);
            return backend_view('permissions.index', compact('permissions'))->with(['cid'=>0,'limit'=>$limit,'search'=>$search]);
        }
        
    }

    /**
     * 详情
     *
     * @param Permission $permission
     * @return mixed
     */
    public function show(Permission $permission)
    {
        return backend_view('permissions.show', compact('permission'));
    }

    /**
     * 创建
     *
     * @param Permission $permission
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request,Permission $permission)
    {
        if (isset($request->all()['id'])) {
            $id = $request->all()['id'];
            $this->authorize('create', $permission);
            return backend_view('permissions.create_and_edit', compact('permission'))->with('cid',$id);
        }else {
            $id = 0;
            $this->authorize('create', $permission);
            return backend_view('permissions.create_and_edit', compact('permission'))->with('cid',$id);
        }
    }

    /**
     * 保存
     *
     * @param Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Permission $permission)
    {
        $this->authorize('create', $permission);
        $user = Permission::create($request->only(['name','remarks','parent_id','grade','summary']));
        return $this->redirect('permissions.index')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param Permission $permission
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission);

        return backend_view('permissions.create_and_edit', compact('permission'));
    }

    /**
     * 更新
     *
     * @param Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        $permission->update($request->only(['name','remarks']));

        return $this->redirect('permissions.index')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('destroy', $permission);

        $permission->delete();

        return $this->redirect()->with('success', '删除成功.');
    }
}
