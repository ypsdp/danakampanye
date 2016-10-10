<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateDataRequest extends Request {

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
            'kabupaten' => 'required', 
            'nama_cakada' => 'required', 
            'nik_cakada' => 'required', 
            'npwp_cakada' => 'required', 
            'alamat_cakada' => 'required', 
            'nama_cawakada' => 'required', 
            'nik_cawakada' => 'required', 
            'npwp_cawakada' => 'required', 
            'alamat_cawakada' => 'required', 
            'ketua_tim' => 'required', 
            'bendahara_tim' => 'required', 
            
		];
	}
}
