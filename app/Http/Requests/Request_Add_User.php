<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class Request_Add_User extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return SUCCESS;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
    public function rules()
    {
        return
            [
                USERNAME => 'required|max:15|unique:'.TB_USER.','.USERNAME,
                PASSWORD => 'required|max:15',

             ];
    }

    public function messages()
    {
        return
            [
                USERNAME.'.required'  => 'UserName is Required.',
                USERNAME.'.max'       => 'UserName exceeds the maximum length.',
                USERNAME.'.unique'    => 'UserName already exists.',

                PASSWORD.'.required'  => 'Password is Required.',
                PASSWORD.'.max'       => 'Password exceeds the maximum length.',
            ];
    }

}
