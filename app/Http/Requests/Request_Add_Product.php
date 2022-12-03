<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Request_Add_Product extends Request
{
    public function authorize()
    {
        return SUCCESS;
    }

    public function rules()
    {
        return
            [
                PRODUCT_NAME => 'required|max:50|unique:' . TB_PRODUCT . ',' . PRODUCT_NAME,
            ];
    }

    public function messages()
    {
        return
            [
                PRODUCT_NAME . '.required'  => 'Particular Name is Required.',
                PRODUCT_NAME . '.max'       => 'Particular Name exceeds the maximum length.',
                PRODUCT_NAME . '.unique'    => 'Particular Name already exists.',
            ];
    }
}
