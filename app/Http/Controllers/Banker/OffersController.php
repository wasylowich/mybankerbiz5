<?php

namespace Mybankerbiz\Http\Controllers\Banker;

use Illuminate\Http\Request;

use Auth;
use Mybankerbiz\Offer;
use Mybankerbiz\Enquiry;
use Mybankerbiz\OfferChance;
use Mybankerbiz\InterestTerm;
use Mybankerbiz\InterestConvention;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Banker\OfferRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class OffersController extends BaseBankerController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $offers = Offer::with('enquiry.depositType')->whereBankId(Auth::user()->bank_id)->get();

        $offers = Auth::user()
                    ->offers()
                    ->with('enquiry.depositType')
                    ->get();

        return view('banker.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Mybankerbiz\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Offer $offer)
    {
        // $id = $request->get('offerChance');
        $offerChance = OfferChance::with('bank', 'enquiry.currency', 'enquiry.depositorProfile.depositorType')
                            ->findOrFail($request->offerChance);

        $interestConventions = InterestConvention::all();
        $interestTerms       = InterestTerm::all();

        return view('banker.offers.form', compact('offer', 'offerChance', 'interestConventions', 'interestTerms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Mybankerbiz\Http\Requests\Admin\OfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        $offerChance = OfferChance::with('bank')->findOrFail($request->offer_chance_id);
        $enquiry     = Enquiry::with('currency')->findOrFail($offerChance->enquiry_id);

        $offer = Auth::user()->offers()->create([
            'state'                  => 'active',
            'fixation_period_months' => $request->fixation_period_months,
            'deadline'               => $request->deadline,
            'interest'               => $request->interest,
            'amount'                 => $enquiry->amount * $request->interest,
            'bank_id'                => $offerChance->bank_id,
            // 'bidder_id'              => $request->bidder_id,
            'enquiry_id'             => $enquiry->id,
            'currency_id'            => $enquiry->currency->id,
            'offer_chance_id'        => $offerChance->id,
            'interest_convention_id' => $offerChance->bank->interest_convention_id,
            'interest_term_id'       => $offerChance->bank->interest_term_id,
        ]);

        // Update the state of the offerChance to 'accepted'
        $offerChance->accept()->save();

        return redirect(route('banker.offers.index'))->with('status', 'Offer has been created.');
    }

    /**
     * Cancel the offer in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $offer = OFfer::findOrFail($id);

        $offer->cancel()->save();

        return redirect(route('banker.offers.index'))->with('status', 'Offer has been cancelled.');
    }
}
