<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

// use Mybankerbiz\Permission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\PermissionRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class PermissionsController extends BaseAdminController
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permission->with('roles')->get();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Permission $permission)
    {
        $roles = Role::all();

        return view('admin.permissions.form', compact('permission', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = $this->permission->create($request->only('name'));

        $permission->syncRoles($request->roles ?: []);

        return redirect(route('admin.permissions.index'))->with('status', 'Permission has been created.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $permission = $this->permission->findOrFail($id);

    //     return view('admin.permissions.form', compact('permission'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles      = Role::all();
        $permission = $this->permission->with('roles')->findOrFail($id);

        return view('admin.permissions.form', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = $this->permission->findOrFail($id);

        $permission->fill($request->only('name'))->save();

        $permission->syncRoles($request->roles ?: []);

        return redirect()->route('admin.permissions.index')->with('status', 'Permission has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->permission->findOrFail($id);

        $permission->delete();

        return redirect(route('admin.permissions.index'))->with('status', 'Permission has been deleted.');
    }
}
