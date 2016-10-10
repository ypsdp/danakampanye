<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Saldo;
use App\Http\Requests\CreateSaldoRequest;
use App\Http\Requests\UpdateSaldoRequest;
use Illuminate\Http\Request;



class SaldoController extends Controller {

	/**
	 * Display a listing of saldo
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $saldo = Saldo::all();

		return view('admin.saldo.index', compact('saldo'));
	}

	/**
	 * Show the form for creating a new saldo
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.saldo.create');
	}

	/**
	 * Store a newly created saldo in storage.
	 *
     * @param CreateSaldoRequest|Request $request
	 */
	public function store(CreateSaldoRequest $request)
	{
	    
		Saldo::create($request->all());

		return redirect()->route('admin.saldo.index');
	}

	/**
	 * Show the form for editing the specified saldo.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$saldo = Saldo::find($id);
	    
	    
		return view('admin.saldo.edit', compact('saldo'));
	}

	/**
	 * Update the specified saldo in storage.
     * @param UpdateSaldoRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateSaldoRequest $request)
	{
		$saldo = Saldo::findOrFail($id);

        

		$saldo->update($request->all());

		return redirect()->route('admin.saldo.index');
	}

	/**
	 * Remove the specified saldo from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Saldo::destroy($id);

		return redirect()->route('admin.saldo.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Saldo::destroy($toDelete);
        } else {
            Saldo::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.saldo.index');
    }

}
