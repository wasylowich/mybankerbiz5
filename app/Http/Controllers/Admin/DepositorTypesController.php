<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mybankerbiz\DepositorType;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\DepositorTypeRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class DepositorTypesController extends BaseAdminController
{
    protected $depositorType;

    public function __construct(DepositorType $depositorType)
    {
        $this->depositorType = $depositorType;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $depositorTypes = $this->depositorType->withTrashed()->paginate(10);
        $depositorTypes = $this->depositorType->withTrashed()->get();
        // $depositorTypes = $this->depositorType->all();

        return view('admin.depositorTypes.index', compact('depositorTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(DepositorType $depositorType)
    {

        return view('admin.depositorTypes.form', compact('depositorType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepositorTypeRequest $request)
    {
        $depositorType = $this->depositorType->create($request->only('name'));

        return redirect(route('admin.depositorTypes.index'))->with('status', 'DepositorType has been created.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $depositorType = $this->depositorType->findOrFail($id);

    //     return view('admin.depositorTypes.form', compact('depositorType'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depositorType = $this->depositorType->findOrFail($id);

        return view('admin.depositorTypes.form', compact('depositorType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepositorTypeRequest $request, $id)
    {
        $depositorType = $this->depositorType->findOrFail($id);

        $depositorType->fill($request->only('name'))->save();

        return redirect()->route('admin.depositorTypes.index')->with('status', 'DepositorType has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $depositorType = $this->depositorType->findOrFail($id);

        $depositorType->delete();

        return redirect(route('admin.depositorTypes.index'))->with('status', 'DepositorType has been deleted.');
    }
}
