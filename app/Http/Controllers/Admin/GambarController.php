<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Gambar;
use App\Http\Requests\CreateGambarRequest;
use App\Http\Requests\UpdateGambarRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class GambarController extends Controller {

	/**
	 * Display a listing of gambar
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $gambar = Gambar::all();

		return view('admin.gambar.index', compact('gambar'));
	}

	/**
	 * Show the form for creating a new gambar
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.gambar.create');
	}

	/**
	 * Store a newly created gambar in storage.
	 *
     * @param CreateGambarRequest|Request $request
	 */
	public function store(CreateGambarRequest $request)
	{
	    $request = $this->saveFiles($request);
		Gambar::create($request->all());

		return redirect()->route('admin.gambar.index');
	}

	/**
	 * Show the form for editing the specified gambar.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$gambar = Gambar::find($id);
	    
	    
		return view('admin.gambar.edit', compact('gambar'));
	}

	/**
	 * Update the specified gambar in storage.
     * @param UpdateGambarRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateGambarRequest $request)
	{
		$gambar = Gambar::findOrFail($id);

        $request = $this->saveFiles($request);

		$gambar->update($request->all());

		return redirect()->route('admin.gambar.index');
	}

	/**
	 * Remove the specified gambar from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Gambar::destroy($id);

		return redirect()->route('admin.gambar.index');
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
            Gambar::destroy($toDelete);
        } else {
            Gambar::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.gambar.index');
    }

}
