<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mybankerbiz\InterestTerm;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\InterestTermRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class InterestTermsController extends BaseAdminController
{
    protected $interestTerm;

    public function __construct(InterestTerm $interestTerm)
    {
        $this->interestTerm = $interestTerm;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $interestTerms = $this->interestTerm->withTrashed()->paginate(10);
        $interestTerms = $this->interestTerm->withTrashed()->get();
        // $interestTerms = $this->interestTerm->all();

        return view('admin.interestTerms.index', compact('interestTerms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(InterestTerm $interestTerm)
    {

        return view('admin.interestTerms.form', compact('interestTerm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterestTermRequest $request)
    {
        $interestTerm = $this->interestTerm->create($request->only('term'));

        flash('InterestTerm has been created.');

        return redirect(route('admin.interestTerms.index'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $interestTerm = $this->interestTerm->findOrFail($id);

    //     return view('admin.interestTerms.form', compact('interestTerm'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $interestTerm = $this->interestTerm->findOrFail($id);

        return view('admin.interestTerms.form', compact('interestTerm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InterestTermRequest $request, $id)
    {
        $interestTerm = $this->interestTerm->findOrFail($id);

        $interestTerm->fill($request->only('term'))->save();

        flash('InterestTerm has been updated.');

        return redirect()->route('admin.interestTerms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interestTerm = $this->interestTerm->findOrFail($id);

        $interestTerm->delete();

        flash('InterestTerm has been deleted.');

        return redirect(route('admin.interestTerms.index'));
    }
}
