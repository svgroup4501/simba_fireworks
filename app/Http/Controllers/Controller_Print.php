<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class Controller_Print extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fun_print_invoice($invoice_inr_id)
    {
        $product_collection   =  DB::table(TB_INVOICE_DETAIL)
            ->where(INVOICE_INR_ID, $invoice_inr_id)
            ->join(TB_PRODUCT, TB_INVOICE_DETAIL . '.' . PRODUCT_INR_ID,  '=', TB_PRODUCT . '.' . PRODUCT_INR_ID)
            ->select(
                TB_PRODUCT . '.' . PRODUCT_INR_ID,
                TB_PRODUCT . '.' . PRODUCT_CODE,
                TB_PRODUCT . '.' . PRODUCT_NAME,
                TB_INVOICE_DETAIL . '.' . QUANTITY,
                TB_INVOICE_DETAIL . '.' . RATE,
                TB_INVOICE_DETAIL . '.' . AMOUNT
            )
            ->orderBy(TB_PRODUCT . '.' . PRODUCT_INR_ID, ASCENDING)
            ->get();
        $pdf_name = $invoice_inr_id . "_" . date("d_m_Y") . "_" . time();
        $customer_collection   =  DB::table(TB_INVOICE)
            ->where(INVOICE_INR_ID, $invoice_inr_id)
            ->get();
        $data = [
            ARRAY_PRODUCT => $product_collection,
            ARRAY_CUSTOMER => $customer_collection
        ];
        $pdf = PDF::loadView('print_invoice', $data);

        return $pdf->download($pdf_name . '.pdf');
    }

    public function fun_print_particular($particular_inr_id)
    {
        $this->delete_exists_pdf_file();
        $particular_customer_collection   =  DB::table(TB_PARTICULAR)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->get();
        $particular_product_collection   =  DB::table(TB_PARTICULAR_DETAIL)
            ->where(PARTICULAR_INR_ID, $particular_inr_id)
            ->get();
        $pdf_name = $particular_inr_id . "_" . date("d_m_Y") . "_" . time() . ".pdf";

        $data  = array(
            ARRAY_CUSTOMER    =>  $particular_customer_collection,
            ARRAY_PARTICULAR  =>  $particular_product_collection
        );
        $pdf = PDF::loadView('print_particular', $data);

        $pdf->save($pdf_name);
        return $pdf->stream();
        //return $pdf->download($pdf_name . '.pdf');
    }

    public function fun_print_account($customer_inr_id)
    {
        $this->delete_exists_pdf_file();
        $account_collection = DB::table(TB_ACCOUNT)
            ->where(CUSTOMER_INR_ID, $customer_inr_id)
            ->orderBy(CREADTED_AT, ASCENDING)->get();
        $customer_collection = DB::table(TB_CUSTOMER)->where(CUSTOMER_INR_ID, $customer_inr_id)->get();
        $pdf_name = $customer_inr_id . "_" . date("d_m_Y") . "_" . time() . ".pdf";
        $data = [
            ARRAY_ACCOUNT => $account_collection,
            ARRAY_CUSTOMER => $customer_collection,
        ];
        $pdf = PDF::loadView('print_account', $data);
        $pdf->save($pdf_name);
        return $pdf->stream();
        //return $pdf->download($pdf_name . '.pdf');
    }

    public function fun_print_account_with_company($company_inr_id)
    {
        $this->delete_exists_pdf_file();
        $account_collection = DB::table(TB_ACCOUNT)
            ->where(COMPANY_INR_ID, $company_inr_id)
            ->orderBy(CREADTED_AT, ASCENDING)->get();
        $company_collection = DB::table(TB_COMPANY)->where(COMPANY_INR_ID, $company_inr_id)->get();
        $pdf_name = $company_inr_id . "_" . date("d_m_Y") . "_" . time() . ".pdf";
        $data = [
            ARRAY_ACCOUNT => $account_collection,
            ARRAY_COMPANY => $company_collection,
        ];
        $pdf = PDF::loadView('print_account_with_company', $data);
        $pdf->save($pdf_name);
        return $pdf->stream();
    }

    public function fun_print_account_with_company_customer(Request $request)
    {
        $company_inr_id   = Input::get("selected_company_inr_id");
        $customer_inr_id  = Input::get("selected_customer_inr_id");
        $this->delete_exists_pdf_file();

        if ($request->submitbutton == "view_report") {
            $account_collection = DB::table(TB_ACCOUNT)
                ->where(COMPANY_INR_ID, $company_inr_id)
                ->where(CUSTOMER_INR_ID, $customer_inr_id)
                ->orderBy(CREADTED_AT, ASCENDING)->get();
            $company_collection = DB::table(TB_COMPANY)->where(COMPANY_INR_ID, $company_inr_id)->get();
            $pdf_name = $company_inr_id . "_" . date("d_m_Y") . "_" . time() . ".pdf";
            $data = [
                ARRAY_ACCOUNT => $account_collection,
                ARRAY_COMPANY => $company_collection,
            ];
            $pdf = PDF::loadView('print_account_with_company_customer', $data);
            $pdf->save($pdf_name);
            return $pdf->stream();
        } else {
            $company_collection = DB::table(TB_COMPANY)->where(COMPANY_INR_ID, $company_inr_id)->get();
            $pdf_name = $company_inr_id . "_" . date("d_m_Y") . "_" . time() . ".pdf";
            $particular_collection   =  DB::table(TB_PARTICULAR)
                ->where(COMPANY_INR_ID, $company_inr_id)
                ->where(CUSTOMER_INR_ID, $customer_inr_id)
                ->get();

            $data  = array(
                ARRAY_PARTICULAR    =>  $particular_collection
            );
            $pdf = PDF::loadView('print_particular_with_customer_company', $data);
            $pdf->save($pdf_name);
            return $pdf->stream();
        }
    }

    public function delete_exists_pdf_file()
    {
        $file_collection = File::allFiles(public_path());
        foreach ($file_collection as $single_file) {
            if ($single_file->getExtension() == "pdf") {
                $pdf_path_name = $single_file->getPathName();
                if (File::exists($pdf_path_name)) {
                    File::delete($pdf_path_name);
                }
            }
        }
    }
}
