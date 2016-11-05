<?php

namespace Mybankerbiz\Http\Controllers\Depositor;

use Illuminate\Http\Request;

use Auth;
use Mybankerbiz\User;
use Mybankerbiz\DepositorType;
use Mybankerbiz\DepositorProfile;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Depositor\DepositorProfileRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class DepositorProfilesController extends BaseDepositorController
{
    protected $depositorProfile;

    public function __construct(DepositorProfile $depositorProfile)
    {
        $this->depositorProfile = $depositorProfile;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depositorProfiles = DepositorProfile::with('depositorType')->whereUserId(Auth::user()->id)->get();

        return view('depositor.depositorProfiles.index', compact('depositorProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Mybankerbiz\DepositorProfile $depositorProfile
     * @return \Illuminate\Http\Response
     */
    public function create(DepositorProfile $depositorProfile)
    {
        $depositorTypes = DepositorType::all();

        return view('depositor.depositorProfiles.form', compact('depositorProfile', 'depositorTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\DepositorProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepositorProfileRequest $request)
    {
        $depositorProfile = Auth::user()->depositorProfiles()->create(
            $request->only([
                'name',
                'vatin',
                'pin',
                'is_primary',
                'is_active',
                'depositor_type_id',
            ])
        );

        return redirect(route('depositor.depositorProfiles.index'))->with('status', 'DepositorProfile has been created.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $depositorProfile = $this->depositorProfile->findOrFail($id);

    //     return view('depositor.depositorProfiles.form', compact('depositorProfile'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depositorProfile = $this->depositorProfile->with('depositorType')->findOrFail($id);
        $depositorTypes   = DepositorType::all();

        return view('depositor.depositorProfiles.form', compact('depositorProfile', 'depositorTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\DepositorProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepositorProfileRequest $request, $id)
    {
        $depositorProfile = $this->depositorProfile->findOrFail($id);

        $depositorProfile->fill(
            $request->only([
                'name',
                'vatin',
                'pin',
                'is_primary',
                'is_active',
                'depositor_type_id'
            ])
        )->save();

        return redirect()->route('depositor.depositorProfiles.index')->with('status', 'DepositorProfile has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $depositorProfile = $this->depositorProfile->findOrFail($id);

        $depositorProfile->delete();

        return redirect(route('depositor.depositorProfiles.index'))->with('status', 'DepositorProfile has been deleted.');
    }
}
