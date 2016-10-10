<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LADKController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function getIndex()
    {
		return view('admin.ladk.index');
	}

}
