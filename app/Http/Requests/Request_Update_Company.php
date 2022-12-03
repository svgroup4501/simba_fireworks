<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Request_Update_Company extends Request
{
    public function authorize()
    {
        return SUCCESS;
    }
    public function rules()
    {
        return
            [
                COMPANY_ADDRESS => 'required',
                COMPANY_GST => 'required',


            ];
    }
    public function messages()
    {
        return
            [
                COMPANY_ADDRESS . '.required'  => 'Company Address is Required.',
                COMPANY_GST . '.required'  => 'GST is Required.',

            ];
    }
}
