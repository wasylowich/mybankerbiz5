<?php

namespace Mybankerbiz\Http\Controllers\Customer;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use Mybankerbiz\User;
use Mybankerbiz\Currency;
use Mybankerbiz\DepositType;
use Mybankerbiz\DepositorProfile;
use Mybankerbiz\Enquiry;
use Mybankerbiz\Enumerations\EnumDepositType;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Customer\EnquiryRequest;
use Mybankerbiz\Events\Customer\EnquiryWasCreated;
// use Mybankerbiz\Http\Controllers\Controller;

class EnquiriesController extends BaseCustomerController
{
    protected $enquiry;

    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquiries = Auth::user()->enquiries()
                        ->with('depositorProfile', 'depositType', 'currency', 'offers.bank', 'offerChances.bank')
                        ->get();

        return view('customer.enquiries.index', compact('enquiries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Mybankerbiz\Enquiry $enquiry
     * @return \Illuminate\Http\Response
     */
    public function create(Enquiry $enquiry)
    {
        $depositorProfiles = DepositorProfile::whereUserId(Auth::user()->id)->get();
        $depositTypes      = DepositType::all();
        $currencies        = Currency::whereIsEnabled(true)->get();

        return view('customer.enquiries.form', compact('enquiry', 'depositorProfiles', 'depositTypes', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\EnquiryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnquiryRequest $request)
    {
        $currency = Currency::findOrFail($request->currency_id);

        // Calculate the bidding deadline taking business days into account
        $buddingDeadlineTimestamp = next_business_day(1, Carbon::now()->addHours(2))->toDateTimeString();
        $biddingDeadline = substr($buddingDeadlineTimestamp, 0, 13) . ':00:00';

        // Calculate the amount to persist using the currency's precision
        $amount = $request->amount * (10 ** $currency->precision);

        // Calculate the fixation period start date
        $fixationStart = $request->deposit_type_id == EnumDepositType::PERIOD && !empty($request->fixation_period_start_date)
                            ? $request->fixation_period_start_date
                            : null;

        // Calculate the fixation period end date
        $fixationEnd = $request->deposit_type_id == EnumDepositType::PERIOD && !empty($request->fixation_period_end_date)
                            ? $request->fixation_period_end_date
                            : null;

        $enquiry = Auth::user()->enquiries()->create([
            'bidding_deadline'           => $biddingDeadline,
            'amount'                     => $amount,
            'fixation_period_start_date' => $fixationStart,
            'fixation_period_end_date'   => $fixationEnd,
            // 'is_active'                  => $request->is_active,
            'depositor_profile_id'       => $request->depositor_profile_id,
            'deposit_type_id'            => $request->deposit_type_id,
            'currency_id'                => $request->currency_id,
        ]);

        // Fire an event indicating that an Enquiry was created
        event(new EnquiryWasCreated($enquiry, Auth::user()));

        return redirect(route('customer.enquiries.index'))->with('status', 'Enquiry has been created.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $enquiry = $this->enquiry->findOrFail($id);

    //     return view('customer.enquiries.form', compact('enquiry'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $enquiry           = $this->enquiry->with('depositType')->findOrFail($id);
    //     $depositorProfiles = DepositorProfile::all();
    //     $currencies        = Currency::whereIsEnabled(true)->get();

    //     return view('customer.enquiries.form', compact('enquiry', 'depositorProfiles', 'currencies'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Mybankerbiz\Http\Requests\Admin\EnquiryRequest  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(EnquiryRequest $request, $id)
    // {
    //     $enquiry = $this->enquiry->findOrFail($id);

    //     $enquiry->fill(
    //         $request->only([
    //             'bidding_deadline',
    //             'amount',
    //             'fixation_period_start_date',
    //             'fixation_period_end_date',
    //             'is_active',
    //             'depositor_profile_id',
    //             'deposit_type_id',
    //             'currency_id',
    //         ])
    //     )->save();

    //     return redirect()->route('customer.enquiries.index')->with('status', 'Enquiry has been updated.');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $enquiry = $this->enquiry->findOrFail($id);

    //     $enquiry->delete();

    //     return redirect(route('customer.enquiries.index'))->with('status', 'Enquiry has been deleted.');
    // }
}
