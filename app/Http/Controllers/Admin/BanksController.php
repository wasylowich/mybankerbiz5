<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Image;
use Storage;
use Mybankerbiz\Bank;
use Mybankerbiz\Country;
use Mybankerbiz\BankType;
use Mybankerbiz\BankProfile;
use Mybankerbiz\InterestConvention;
use Mybankerbiz\InterestTerm;
use Mybankerbiz\RebateType;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\LogoRequest;
use Mybankerbiz\Http\Requests\Admin\BankRequest;
use Mybankerbiz\Http\Requests\Admin\BankProfileRequest;
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
     * @param  Mybankerbiz\Bank $bank
     * @return \Illuminate\Http\Response
     */
    public function create(Bank $bank)
    {
        $countries           = Country::all();
        $bankTypes           = BankType::all();
        $interestConventions = InterestConvention::all();
        $interestTerms       = InterestTerm::all();
        $rebateTypes         = RebateType::all();

        return view('admin.banks.create', compact('bank', 'countries', 'bankTypes', 'interestConventions', 'interestTerms', 'rebateTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\BankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankRequest $request)
    {
        $bank = $this->bank->create(
            $request->only([
                'name',
                'country_id',
                'vatin',
                'website',
                'is_active',
                'bank_type_id',
                'interest_convention_id',
                'interest_term_id',
                'pension_interest_convention_id',
                'change_of_control',
                'rebate_type_id',
                'rebate_message',
            ])
        );

        flash('Bank has been created.');

        return redirect(route('admin.banks.index'));
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
        $bank                = $this->bank->with('profile')->findOrFail($id);
        $countries           = Country::all();
        $bankTypes           = BankType::all();
        $interestConventions = InterestConvention::all();
        $interestTerms       = InterestTerm::all();
        $rebateTypes         = RebateType::all();

        return view('admin.banks.edit', compact('bank', 'countries', 'bankTypes', 'interestConventions', 'interestTerms', 'rebateTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\BankRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BankRequest $request, $id)
    {
        $bank = $this->bank->findOrFail($id);

        $bank->fill(
            $request->only([
                'name',
                'country_id',
                'vatin',
                'website',
                'is_active',
                'bank_type_id',
                'interest_convention_id',
                'interest_term_id',
                'pension_interest_convention_id',
                'change_of_control',
                'rebate_type_id',
                'rebate_message',
            ])
        )->save();

        flash('Bank has been updated.');

        return redirect()->route('admin.banks.index');
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

        flash('Bank has been deleted.');

        return redirect(route('admin.banks.index'));
    }

    /**
     * Show the form for editing the bank profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile($id)
    {
        $bank = $this->bank->with('profile')->findOrFail($id);

        return view('admin.banks.profile', compact('bank'));
    }

    /**
     * Update the bank profile in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\BankProfileRequest  $request
     * @param  Mybankerbiz\BankProfile $bankProfile
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(BankProfileRequest $request, BankProfile $bankProfile, $id)
    {
        $profile = $bankProfile->whereBankId($id)->first();

        $profile->fill($request->only('annual_report', 'bio'))->save();

        flash('Bank profile has been updated.');

        return back();
    }

    /**
     * Update the bank logo in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\LogoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLogo(LogoRequest $request, BankProfile $bankProfile, $id)
    {
        $profile = $bankProfile->whereBankId($id)->first();

        $file = request()->file('logo');
        $ext  = $file->extension();

        $logo = Image::make($file)->fit(250, 100)->stream();

        $path = 'logos/' . "{$id}.{$ext}";
        Storage::disk('public')->put($path, $logo);

        $profile->logo = Storage::disk('public')->url($path);
        $profile->save();

        return back();
    }
}
