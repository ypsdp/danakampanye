<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Data;
use App\Http\Requests\CreateDataRequest;
use App\Http\Requests\UpdateDataRequest;
use Illuminate\Http\Request;

use App\Jnspemilihan;


class DataController extends Controller {

	/**
	 * Display a listing of data
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $data = Data::with("jnspemilihan")->get();

		return view('admin.data.index', compact('data'));
	}

	/**
	 * Show the form for creating a new data
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $jnspemilihan = Jnspemilihan::lists("", "id")->prepend('Please select', '');

	    
	    return view('admin.data.create', compact("jnspemilihan"));
	}

	/**
	 * Store a newly created data in storage.
	 *
     * @param CreateDataRequest|Request $request
	 */
	public function store(CreateDataRequest $request)
	{
	    
		Data::create($request->all());

		return redirect()->route('admin.data.index');
	}

	/**
	 * Show the form for editing the specified data.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$data = Data::find($id);
	    $jnspemilihan = Jnspemilihan::lists("", "id")->prepend('Please select', '');

	    
		return view('admin.data.edit', compact('data', "jnspemilihan"));
	}

	/**
	 * Update the specified data in storage.
     * @param UpdateDataRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateDataRequest $request)
	{
		$data = Data::findOrFail($id);

        

		$data->update($request->all());

		return redirect()->route('admin.data.index');
	}

	/**
	 * Remove the specified data from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Data::destroy($id);

		return redirect()->route('admin.data.index');
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
            Data::destroy($toDelete);
        } else {
            Data::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.data.index');
    }

}
