<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use Image;
use Storage;
use Mybankerbiz\User;
use Mybankerbiz\UserProfile;
use Spatie\Permission\Models\Role;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\AvatarRequest;
use Mybankerbiz\Http\Requests\Admin\UserRequest;
use Mybankerbiz\Http\Requests\Admin\UserProfileRequest;
use Mybankerbiz\Http\Requests\Admin\ChangePasswordRequest;
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
        $users = $this->user->with('roles', 'profile.membership')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Mybankerbiz\User  $user
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $roles = Role::all();

        return view('admin.users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\UserRequest  $request
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

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);

        $user->fill($request->only('name', 'email'))->save();

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

    /**
     * Show the form for editing the authenticated user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $user = Auth::user();
        $user->profile;

        return view('admin.users.profile', compact('user'));
    }

    /**
     * Update the authenticated user profile in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\UserProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UserProfileRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);

        $user->fill($request->only('name', 'email'))->save();

        return back()->with('status', 'User profile has been updated.');
    }

    /**
     * Update the authenticated user profile in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\ChangePasswordRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePasswordRequest $request, $id)
    {
        $user = Auth::user();

        $user->fill($request->only('password'))->save();

        return back()->with('status', 'User password has been changed.');
    }

    /**
     * Update the authenticated user avatar in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\AvatarRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(AvatarRequest $request, UserProfile $userProfile, $id)
    {
        $profile = $userProfile->whereUserId($id)->first();

        $file = request()->file('avatar');
        $ext  = $file->extension();

        $avatar = Image::make($file)->fit(215)->stream();

        $path = 'avatars/' . auth()->id() . ".{$ext}";
        Storage::disk('public')->put($path, $avatar);

        $profile->avatar = Storage::disk('public')->url($path);
        $profile->save();

        return back();
    }
}
