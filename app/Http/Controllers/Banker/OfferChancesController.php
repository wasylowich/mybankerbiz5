<?php

namespace Mybankerbiz\Http\Controllers\Banker;

use Illuminate\Http\Request;

use Auth;
use Mybankerbiz\OfferChance;
use Mybankerbiz\Http\Requests;
// use Mybankerbiz\Http\Controllers\Controller;

class OfferChancesController extends BaseBankerController
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
        // TODO: Improve this query? (possibly use scopes, or repository or query object)
        $offerChances = Auth::user()
                    ->bank()
                    ->firstOrFail()
                    ->offerChances()
                    ->with('enquiry.depositType')
                    ->whereState('under_consideration')
                    ->get();

        return view('banker.offerChances.index', compact('offerChances'));
    }

    /**
     * Decline the offerChance in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function decline($id)
    {
        $offerChance = OfferChance::findOrFail($id);

        $offerChance->decline()->save();

        return redirect(route('banker.offerChances.index'))->with('status', 'OfferChance has been declined.');
    }
}
