<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Classes\Class_Database;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpWord\IOFactory;

class Controller_Company extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fun_view_add_company()
    {
        $data = DB::table(TB_COMPANY)->orderBy(COMPANY_INR_ID, ASCENDING)->paginate(50);
        return View('view_add_company')->with(compact('data'));
    }

    public function fun_store_company(Requests\Request_Add_Company $request)
    {
        $return_value =  DB::table(TB_COMPANY)->insertGetId([
            COMPANY_NAME => $request->Input(COMPANY_NAME),
            COMPANY_ADDRESS => $request->Input(COMPANY_ADDRESS),
            COMPANY_GST => $request->Input(COMPANY_GST),
        ]);

        if ($return_value != RECORD_NOT_INSERTED) {
            return Class_Database::return_FM_Success("Company Inserted Successfully ", 'view_add_company');
        } else {
            return Class_Database::return_FM_Error(" Error in Inserting Company ", 'view_add_company');
        }
    }

    public function fun_view_all_company()
    {
        $array_collection  =  DB::table(TB_COMPANY)->select(COMPANY_INR_ID)->get();
        if (count($array_collection) != ZERO) {
            $data = DB::table(TB_COMPANY)->orderBy(COMPANY_INR_ID, ASCENDING)->paginate(50);
            return View('view_all_company')->with(compact('data'));
        } else {
            Class_Database::return_FM_Warning(" No Records In Company Table ", '/');
        }
    }

    public function fun_view_update_company($company_inr_id)
    {
        $company_collection = DB::table(TB_COMPANY)->where(COMPANY_INR_ID, '=', $company_inr_id)->get();
        return View('view_update_company')->with(ARRAY_COMPANY, $company_collection);
    }

    public static function fun_update_company(Requests\Request_Update_Company $request, $company_inr_id)
    {
        DB::table(TB_COMPANY)
            ->where(COMPANY_INR_ID, $company_inr_id)
            ->update([
                COMPANY_NAME => $request->Input(COMPANY_NAME),
                COMPANY_ADDRESS => $request->Input(COMPANY_ADDRESS),
                COMPANY_GST => $request->Input(COMPANY_GST),
            ]);
        DB::table(TB_PARTICULAR)
            ->where(COMPANY_INR_ID, $company_inr_id)
            ->update([
                COMPANY_NAME => $request->Input(COMPANY_NAME),
            ]);
        DB::table(TB_ACCOUNT)
            ->where(COMPANY_INR_ID, $company_inr_id)
            ->update([
                COMPANY_NAME => $request->Input(COMPANY_NAME),
            ]);
        return Class_Database::return_FM_Success("Company Updated Successfully ", 'view_add_company');
    }

    public function fun_delete_company($company_inr_id)
    {
        $return_value   =  DB::table(TB_COMPANY)
            ->where(COMPANY_INR_ID, $company_inr_id)
            ->delete();

        if ($return_value == RECORD_DELETED) {
            return Class_Database::return_FM_Success("Company Deleted Successfully ", 'view_add_company');
        } else {
            return Class_Database::return_FM_Error("Error in Deleting Company ", 'view_add_company');
        }
    }
}
