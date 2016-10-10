<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Pengeluaran;
use App\Http\Requests\CreatePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;
use Illuminate\Http\Request;

use App\Jnspengeluaran;


class PengeluaranController extends Controller {

	/**
	 * Display a listing of pengeluaran
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $pengeluaran = Pengeluaran::with("jnspengeluaran")->get();

		return view('admin.pengeluaran.index', compact('pengeluaran'));
	}

	/**
	 * Show the form for creating a new pengeluaran
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $jnspengeluaran = Jnspengeluaran::get()->lists("kategori", "id")->prepend('Please select', '');

	    
	    return view('admin.pengeluaran.create', compact("jnspengeluaran"));
	}

	/**
	 * Store a newly created pengeluaran in storage.
	 *
     * @param CreatePengeluaranRequest|Request $request
	 */
	public function store(CreatePengeluaranRequest $request)
	{
	    
		Pengeluaran::create($request->all());

		return redirect()->route('admin.pengeluaran.index');
	}

	/**
	 * Show the form for editing the specified pengeluaran.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$pengeluaran = Pengeluaran::find($id);
	    $jnspengeluaran = Jnspengeluaran::get()->lists("kategori", "id")->prepend('Please select', '');

	    
		return view('admin.pengeluaran.edit', compact('pengeluaran', "jnspengeluaran"));
	}

	/**
	 * Update the specified pengeluaran in storage.
     * @param UpdatePengeluaranRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePengeluaranRequest $request)
	{
		$pengeluaran = Pengeluaran::findOrFail($id);

        

		$pengeluaran->update($request->all());

		return redirect()->route('admin.pengeluaran.index');
	}

	/**
	 * Remove the specified pengeluaran from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Pengeluaran::destroy($id);

		return redirect()->route('admin.pengeluaran.index');
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
            Pengeluaran::destroy($toDelete);
        } else {
            Pengeluaran::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.pengeluaran.index');
    }

}
