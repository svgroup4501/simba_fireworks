<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Request_Update_Customer extends Request
{
    public function authorize()
    {
        return SUCCESS;
    }
    public function rules()
    {
        return
            [
                CUSTOMER_NAME => 'required|max:50',

            ];
    }
    public function messages()
    {
        return
            [
                CUSTOMER_NAME . '.required'  => 'Customer Name is Required.',
                CUSTOMER_NAME . '.max'       => 'Customer Name exceeds the maximum length.',

            ];
    }
}
