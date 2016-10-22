<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

// use Mybankerbiz\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\RoleRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class RolesController extends BaseAdminController
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->with('permissions')->get();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.form', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = $this->role->create($request->only('name'));

        $role->syncPermissions($request->permissions ?: []);

        return redirect(route('admin.roles.index'))->with('status', 'Role has been created.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $role = $this->role->findOrFail($id);

    //     return view('admin.roles.form', compact('role'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->role->with('permissions')->findOrFail($id);
        $permissions = Permission::all();

        return view('admin.roles.form', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = $this->role->findOrFail($id);

        $role->fill($request->only('name'))->save();

        $role->syncPermissions($request->permissions ?: []);

        return redirect()->route('admin.roles.index')->with('status', 'Role has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->role->findOrFail($id);

        $role->delete();

        return redirect(route('admin.roles.index'))->with('status', 'Role has been deleted.');
    }
}
