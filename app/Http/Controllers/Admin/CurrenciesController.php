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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $currencies = $this->currency->withTrashed()->paginate(10);
        $currencies = $this->currency->withTrashed()->get();
        // $currencies = $this->currency->all();

        return view('admin.currencies.index', compact('currencies'));
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
        $currency = $this->currency->create($request->only('name', 'code', 'precision'));

        return redirect(route('admin.currencies.index'))->with('status', 'Currency has been created.');
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

        $currency->name      = $request->name;
        $currency->code      = $request->code;
        $currency->precision = $request->precision;

        $currency->save();

        return redirect()->route('admin.currencies.index')->with('status', 'Currency has been updated.');
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

        return redirect(route('admin.currencies.index'))->with('status', 'Currency has been deleted.');
    }
}
