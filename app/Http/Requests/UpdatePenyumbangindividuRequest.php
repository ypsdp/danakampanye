<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePenyumbangindividuRequest extends Request {

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
            'nik' => 'required|unique:penyumbangindividu,nik,'.$this->penyumbangindividu, 
            'nama' => 'required', 
            'tempat_lahir' => 'required', 
            'tgl_lahir' => 'required', 
            'alamat' => 'required', 
            
		];
	}
}
