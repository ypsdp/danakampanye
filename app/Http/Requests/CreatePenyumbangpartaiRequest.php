<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePenyumbangpartaiRequest extends Request {

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
            'nama' => 'required', 
            'alamat' => 'required', 
            'no_akte' => 'required', 
            'npwp' => 'required', 
            'nama_pimpinan' => 'required', 
            'alamat_pimpinan' => 'required', 
            'telepon_pimpinan' => 'required', 
            
		];
	}
}
