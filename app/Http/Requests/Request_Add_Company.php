<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Request_Add_Company extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return SUCCESS;
    }

    public function rules()
    {
        return
            [
                COMPANY_NAME => 'required|max:50|unique:' . TB_COMPANY . ',' . COMPANY_NAME,
                COMPANY_ADDRESS => 'required',
                COMPANY_GST => 'required',

            ];
    }

    public function messages()
    {
        return
            [
                COMPANY_NAME . '.required'  => 'Company Name is Required.',
                COMPANY_NAME . '.max'       => 'Company Name exceeds the maximum length.',
                COMPANY_NAME . '.unique'    => 'Company Name already exists.',

                COMPANY_ADDRESS . '.required'  => 'Company Address is Required.',

                COMPANY_GST . '.required'  => 'GST is Required.',
            ];
    }
}
