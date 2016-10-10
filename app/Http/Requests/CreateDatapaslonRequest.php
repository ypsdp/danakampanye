<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateDatapaslonRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'jnspemilihan_id' => 'required', 
            'provinsi' => 'required', 
            'kabupaten_kota' => 'required', 
            'ketua_tim' => 'required', 
            'bendahara_tim' => 'required', 
            'no_reksus' => 'required', 
            
		];
	}
}
