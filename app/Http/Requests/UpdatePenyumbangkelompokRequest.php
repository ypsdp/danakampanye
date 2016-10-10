<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePenyumbangkelompokRequest extends Request {

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
            'identitas_pimpinan' => 'required', 
            'telepon' => 'required', 
            'nama_pemimpin' => 'required', 
            'alamat_pemimpin' => 'required', 
            'status' => 'required', 
            
		];
	}
}
