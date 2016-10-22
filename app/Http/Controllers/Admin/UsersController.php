<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mybankerbiz\User;
use Spatie\Permission\Models\Role;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\UserRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class UsersController extends BaseAdminController
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->with('roles')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $roles = Role::all();

        return view('admin.users.form', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->user->create($request->only('name', 'email', 'password'));

        $user->syncRoles($request->roles ?: []);

        return redirect(route('admin.users.index'))->with('status', 'User has been created.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $user = $this->user->findOrFail($id);

    //     return view('admin.users.form', compact('user'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
        $roles = Role::all();

        return view('admin.users.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);

        $user->fill($request->only('name', 'email', 'password'))->save();

        $user->syncRoles($request->roles ?: []);

        return redirect()->route('admin.users.index')->with('status', 'User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);

        $user->delete();

        return redirect(route('admin.users.index'))->with('status', 'User has been deleted.');
    }
}
