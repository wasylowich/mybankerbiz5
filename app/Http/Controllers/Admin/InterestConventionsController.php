<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mybankerbiz\InterestConvention;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\InterestConventionRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class InterestConventionsController extends BaseAdminController
{
    protected $interestConvention;

    public function __construct(InterestConvention $interestConvention)
    {
        $this->interestConvention = $interestConvention;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $interestConventions = $this->interestConvention->withTrashed()->paginate(10);
        $interestConventions = $this->interestConvention->withTrashed()->get();
        // $interestConventions = $this->interestConvention->all();

        return view('admin.interestConventions.index', compact('interestConventions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(InterestConvention $interestConvention)
    {

        return view('admin.interestConventions.form', compact('interestConvention'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterestConventionRequest $request)
    {
        $interestConvention = $this->interestConvention->create($request->only('convention'));

        flash('InterestConvention has been created.');

        return redirect(route('admin.interestConventions.index'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $interestConvention = $this->interestConvention->findOrFail($id);

    //     return view('admin.interestConventions.form', compact('interestConvention'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $interestConvention = $this->interestConvention->findOrFail($id);

        return view('admin.interestConventions.form', compact('interestConvention'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InterestConventionRequest $request, $id)
    {
        $interestConvention = $this->interestConvention->findOrFail($id);

        $interestConvention->fill($request->only('convention'))->save();

        flash('InterestConvention has been updated.');

        return redirect()->route('admin.interestConventions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interestConvention = $this->interestConvention->findOrFail($id);

        $interestConvention->delete();

        flash('InterestConvention has been deleted.');

        return redirect(route('admin.interestConventions.index'));
    }
}
