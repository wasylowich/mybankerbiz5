<?php

namespace Mybankerbiz\Http\Controllers\Customer;

use Illuminate\Http\Request;

use Auth;
use Mybankerbiz\Offer;
use Mybankerbiz\Http\Requests;
// use Mybankerbiz\Http\Controllers\Controller;

class OffersController extends BaseCustomerController
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
        // $offers = Offer::with('enquiry.depositType')->get();
        $offers = Auth::user()->offersReceived()->with('enquiry.depositType', 'enquiry.currency', 'bank')->get();

        return view('customer.offers.index', compact('offers'));
    }

    /**
     * Accept the offer in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $offer = Offer::findOrFail($id);

        $offer->accept()->save();

        return redirect(route('customer.offers.index'))->with('status', 'Offer has been accepted.');
    }

    /**
     * Reject the offer in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $offer = Offer::findOrFail($id);

        $offer->reject()->save();

        return redirect(route('customer.offers.index'))->with('status', 'Offer has been rejected.');
    }
}
