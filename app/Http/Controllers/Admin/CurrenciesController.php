<?php

namespace Mybankerbiz\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mybankerbiz\Currency;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Admin\CurrencyRequest;
// use Mybankerbiz\Http\Controllers\Controller;

class CurrenciesController extends BaseAdminController
{
    protected $currency;

    public function __construct(Currency $currency)
    {
        $this->currency = $currency;

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
        $currencies = $this->currency->enabled()->get();
        $path       = $request->path();

        return view('admin.currencies.index', compact('currencies', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Currency $currency)
    {
        return view('admin.currencies.form', compact('currency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        $currency = $this->currency->create(
            $request->only([
                'name',
                'code',
                'precision',
                'is_enabled',
            ])
        );

        flash('Currency has been created.');

        return redirect(route('admin.currencies.index'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $currency = $this->currency->findOrFail($id);

    //     return view('admin.currencies.form', compact('currency'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = $this->currency->findOrFail($id);

        return view('admin.currencies.form', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, $id)
    {
        $currency = $this->currency->findOrFail($id);

        $currency->fill(
            $request->only([
                'name',
                'code',
                'precision',
                'is_enabled',
            ])
        )->save();

        flash('Currency has been updated.');

        return redirect()->route('admin.currencies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = $this->currency->findOrFail($id);

        $currency->delete();

        flash('Currency has been deleted.');

        return redirect(route('admin.currencies.index'));
    }

    /**
     * Display a listing of the disabled currencies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disabled(Request $request)
    {
        $currencies = $this->currency->disabled()->get();
        $path       = $request->path();

        return view('admin.currencies.index', compact('currencies', 'path'));
    }

    /**
     * Enable/disable the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleEnabled($id)
    {
        $currency = $this->currency->findOrFail($id);

        $currency->toggleEnabled()->save();

        flash('Currency has been deleted.');

        return redirect(route('admin.currencies.index'));
    }
}
