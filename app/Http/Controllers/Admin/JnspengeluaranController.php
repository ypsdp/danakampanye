<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Jnspengeluaran;
use App\Http\Requests\CreateJnspengeluaranRequest;
use App\Http\Requests\UpdateJnspengeluaranRequest;
use Illuminate\Http\Request;



class JnspengeluaranController extends Controller {

	/**
	 * Display a listing of jnspengeluaran
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $jnspengeluaran = Jnspengeluaran::all();

		return view('admin.jnspengeluaran.index', compact('jnspengeluaran'));
	}

	/**
	 * Show the form for creating a new jnspengeluaran
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.jnspengeluaran.create');
	}

	/**
	 * Store a newly created jnspengeluaran in storage.
	 *
     * @param CreateJnspengeluaranRequest|Request $request
	 */
	public function store(CreateJnspengeluaranRequest $request)
	{
	    
		Jnspengeluaran::create($request->all());

		return redirect()->route('admin.jnspengeluaran.index');
	}

	/**
	 * Show the form for editing the specified jnspengeluaran.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$jnspengeluaran = Jnspengeluaran::find($id);
	    
	    
		return view('admin.jnspengeluaran.edit', compact('jnspengeluaran'));
	}

	/**
	 * Update the specified jnspengeluaran in storage.
     * @param UpdateJnspengeluaranRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateJnspengeluaranRequest $request)
	{
		$jnspengeluaran = Jnspengeluaran::findOrFail($id);

        

		$jnspengeluaran->update($request->all());

		return redirect()->route('admin.jnspengeluaran.index');
	}

	/**
	 * Remove the specified jnspengeluaran from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Jnspengeluaran::destroy($id);

		return redirect()->route('admin.jnspengeluaran.index');
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
            Jnspengeluaran::destroy($toDelete);
        } else {
            Jnspengeluaran::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.jnspengeluaran.index');
    }

}
