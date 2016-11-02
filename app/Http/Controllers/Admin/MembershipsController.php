<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mybankerbiz\Membership;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\MembershipRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class MembershipsController extends BaseAdminController
{
    protected $membership;

    public function __construct(Membership $membership)
    {
        $this->membership = $membership;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $memberships = $this->membership->withTrashed()->paginate(10);
        $memberships = $this->membership->withTrashed()->get();
        // $memberships = $this->membership->all();

        return view('admin.memberships.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Membership $membership)
    {

        return view('admin.memberships.form', compact('membership'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MembershipRequest $request)
    {
        $membership = $this->membership->create($request->only('name'));

        return redirect(route('admin.memberships.index'))->with('status', 'Membership has been created.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $membership = $this->membership->findOrFail($id);

    //     return view('admin.memberships.form', compact('membership'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $membership = $this->membership->findOrFail($id);

        return view('admin.memberships.form', compact('membership'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MembershipRequest $request, $id)
    {
        $membership = $this->membership->findOrFail($id);

        $membership->fill($request->only('name'))->save();

        return redirect()->route('admin.memberships.index')->with('status', 'Membership has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $membership = $this->membership->findOrFail($id);

        $membership->delete();

        return redirect(route('admin.memberships.index'))->with('status', 'Membership has been deleted.');
    }
}
