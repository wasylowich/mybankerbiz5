<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mybankerbiz\BankType;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\BankTypeRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class BankTypesController extends BaseAdminController
{
    protected $bankType;

    public function __construct(BankType $bankType)
    {
        $this->bankType = $bankType;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $bankTypes = $this->bankType->withTrashed()->paginate(10);
        $bankTypes = $this->bankType->withTrashed()->get();
        // $bankTypes = $this->bankType->all();

        return view('admin.bankTypes.index', compact('bankTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(BankType $bankType)
    {

        return view('admin.bankTypes.form', compact('bankType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankTypeRequest $request)
    {
        $bankType = $this->bankType->create($request->only('type'));

        flash('BankType has been created.');

        return redirect(route('admin.bankTypes.index'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $bankType = $this->bankType->findOrFail($id);

    //     return view('admin.bankTypes.form', compact('bankType'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bankType = $this->bankType->findOrFail($id);

        return view('admin.bankTypes.form', compact('bankType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BankTypeRequest $request, $id)
    {
        $bankType = $this->bankType->findOrFail($id);

        $bankType->fill($request->only('type'))->save();

        flash('BankType has been updated.');

        return redirect()->route('admin.bankTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bankType = $this->bankType->findOrFail($id);

        $bankType->delete();

        flash('BankType has been deleted.');

        return redirect(route('admin.bankTypes.index'));
    }
}
