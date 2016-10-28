<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mybankerbiz\Country;
use Mybankerbiz\Currency;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\CountryRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class CountriesController extends BaseAdminController
{
    protected $country;

    public function __construct(Country $country)
    {
        $this->country = $country;

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = $this->country->with('defaultCurrency')->enabled()->get();
        $path      = $request->path();

        return view('admin.countries.index', compact('countries', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Country $country)
    {
        $currencies = Currency::all();

        return view('admin.countries.form', compact('country', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $country = $this->country->create(
            $request->only([
                'name',
                'local_short_form',
                'abbreviation',
                'iso_alpha_2',
                'iso_alpha_3',
                'telephone_code',
                'tld',
                'is_enabled',
                'default_currency_id',
            ])
        );

        return redirect(route('admin.countries.index'))->with('status', 'Country has been created.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $country = $this->country->findOrFail($id);

    //     return view('admin.countries.form', compact('country'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = $this->country->findOrFail($id);
        $currencies = Currency::all();

        return view('admin.countries.form', compact('country', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        $country = $this->country->findOrFail($id);

        $country->fill(
            $request->only([
                'name',
                'local_short_form',
                'abbreviation',
                'iso_alpha_2',
                'iso_alpha_3',
                'telephone_code',
                'tld',
                'is_enabled',
                'default_currency_id',
            ])
        )->save();

        return redirect()->route('admin.countries.index')->with('status', 'Country has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = $this->country->findOrFail($id);

        $country->delete();

        return redirect(route('admin.countries.index'))->with('status', 'Country has been deleted.');
    }

    /**
     * Display a listing of the disabled countries.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disabled(Request $request)
    {
        $countries = $this->country->with('defaultCurrency')->disabled()->get();
        $path      = $request->path();

        return view('admin.countries.index', compact('countries', 'path'));
    }

    /**
     * Enable/disable the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleEnabled($id)
    {
        $country = $this->country->findOrFail($id);

        $country->toggleEnabled()->save();

        return redirect(route('admin.countries.index'))->with('status', 'Country has been deleted.');
    }
}
