<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Jnspemilihan;
use App\Http\Requests\CreateJnspemilihanRequest;
use App\Http\Requests\UpdateJnspemilihanRequest;
use Illuminate\Http\Request;



class JnspemilihanController extends Controller {

	/**
	 * Display a listing of jnspemilihan
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $jnspemilihan = Jnspemilihan::all();

		return view('admin.jnspemilihan.index', compact('jnspemilihan'));
	}

	/**
	 * Show the form for creating a new jnspemilihan
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.jnspemilihan.create');
	}

	/**
	 * Store a newly created jnspemilihan in storage.
	 *
     * @param CreateJnspemilihanRequest|Request $request
	 */
	public function store(CreateJnspemilihanRequest $request)
	{
	    
		Jnspemilihan::create($request->all());

		return redirect()->route('admin.jnspemilihan.index');
	}

	/**
	 * Show the form for editing the specified jnspemilihan.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$jnspemilihan = Jnspemilihan::find($id);
	    
	    
		return view('admin.jnspemilihan.edit', compact('jnspemilihan'));
	}

	/**
	 * Update the specified jnspemilihan in storage.
     * @param UpdateJnspemilihanRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateJnspemilihanRequest $request)
	{
		$jnspemilihan = Jnspemilihan::findOrFail($id);

        

		$jnspemilihan->update($request->all());

		return redirect()->route('admin.jnspemilihan.index');
	}

	/**
	 * Remove the specified jnspemilihan from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Jnspemilihan::destroy($id);

		return redirect()->route('admin.jnspemilihan.index');
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
            Jnspemilihan::destroy($toDelete);
        } else {
            Jnspemilihan::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.jnspemilihan.index');
    }

}
