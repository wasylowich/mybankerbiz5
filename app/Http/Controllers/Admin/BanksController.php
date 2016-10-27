<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mybankerbiz\Bank;
use Mybankerbiz\BankType;
use Mybankerbiz\InterestConvention;
use Mybankerbiz\InterestTerm;
use Mybankerbiz\RebateType;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\BankRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class BanksController extends BaseAdminController
{
    protected $bank;

    public function __construct(Bank $bank)
    {
        $this->bank = $bank;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $banks = $this->bank->withTrashed()->paginate(10);
        // $banks = $this->bank->withTrashed()->get();
        $banks = $this->bank->with('country', 'bankType', 'interestConvention', 'interestTerm', 'pensionInterestConvention', 'rebateType')->get();

        return view('admin.banks.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Bank $bank)
    {
        $bankTypes           = BankType::all();
        $interestConventions = InterestConvention::all();
        $interestTerms       = InterestTerm::all();
        $rebateTypes         = RebateType::all();

        return view('admin.banks.form', compact('bank', 'bankTypes', 'interestConventions', 'interestTerms', 'rebateTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankRequest $request)
    {
        $bank = $this->bank->create(
            $request->only([
                'name',
                'vatin',
                'website',
                'status',
                'bank_type_id',
                'interest_convention_id',
                'interest_term_id',
                'pension_interest_convention_id',
                'rebate_type_id',
            ])
        );

        return redirect(route('admin.banks.index'))->with('status', 'Bank has been created.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $bank = $this->bank->findOrFail($id);

    //     return view('admin.banks.form', compact('bank'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank                = $this->bank->findOrFail($id);
        $bankTypes           = BankType::all();
        $interestConventions = InterestConvention::all();
        $interestTerms       = InterestTerm::all();
        $rebateTypes         = RebateType::all();

        return view('admin.banks.form', compact('bank', 'bankTypes', 'interestConventions', 'interestTerms', 'rebateTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BankRequest $request, $id)
    {
        $bank = $this->bank->findOrFail($id);

        $bank->fill(
            $request->only([
                'name',
                'vatin',
                'website',
                'status',
                'bank_type_id',
                'interest_convention_id',
                'interest_term_id',
                'pension_interest_convention_id',
                'rebate_type_id',
            ])
        )->save();

        return redirect()->route('admin.banks.index')->with('status', 'Bank has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = $this->bank->findOrFail($id);

        $bank->delete();

        return redirect(route('admin.banks.index'))->with('status', 'Bank has been deleted.');
    }
}
