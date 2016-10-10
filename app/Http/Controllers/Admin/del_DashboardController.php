<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Penyumbangpaslon;
use App\Http\Requests\CreatePenyumbangpaslonRequest;
use App\Http\Requests\UpdatePenyumbangpaslonRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class PenyumbangpaslonController extends Controller {

	/**
	 * Display a listing of penyumbangpaslon
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $penyumbangpaslon = Penyumbangpaslon::all();

		return view('admin.penyumbangpaslon.index', compact('penyumbangpaslon'));
	}

	/**
	 * Show the form for creating a new penyumbangpaslon
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.penyumbangpaslon.create');
	}

	/**
	 * Store a newly created penyumbangpaslon in storage.
	 *
     * @param CreatePenyumbangpaslonRequest|Request $request
	 */
	public function store(CreatePenyumbangpaslonRequest $request)
	{
	    $request = $this->saveFiles($request);
		Penyumbangpaslon::create($request->all());

		return redirect()->route('admin.penyumbangpaslon.index');
	}

	/**
	 * Show the form for editing the specified penyumbangpaslon.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$penyumbangpaslon = Penyumbangpaslon::find($id);
	    
	    
		return view('admin.penyumbangpaslon.edit', compact('penyumbangpaslon'));
	}

	/**
	 * Update the specified penyumbangpaslon in storage.
     * @param UpdatePenyumbangpaslonRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePenyumbangpaslonRequest $request)
	{
		$penyumbangpaslon = Penyumbangpaslon::findOrFail($id);

        $request = $this->saveFiles($request);

		$penyumbangpaslon->update($request->all());

		return redirect()->route('admin.penyumbangpaslon.index');
	}

	/**
	 * Remove the specified penyumbangpaslon from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Penyumbangpaslon::destroy($id);

		return redirect()->route('admin.penyumbangpaslon.index');
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
            Penyumbangpaslon::destroy($toDelete);
        } else {
            Penyumbangpaslon::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.penyumbangpaslon.index');
    }

}
