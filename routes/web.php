<?php

//********************************** Database and Table Name ******************************************//

define('DEFAULT_IMPORT_STOCK', true); // Stock Increment Id
define('DEFAULT_IMPORT_STOCK_VALUE', '100000'); // Stock Increment Id
define('TB_DB_BACKUP','db_backup');
define('TB_PRODUCT', 'product');
define('TB_CUSTOMER', 'customer');
define('TB_COMPANY', 'company');
define('TB_USER', 'users');
define('TB_STOCK', 'stock');
define('TB_PURCHASE', 'purchase');
define('TB_PURCHASE_DETAIL', 'purchase_detail');
define('TB_INVOICE', 'invoice');
define('TB_INVOICE_DETAIL', 'invoice_detail');
define('TB_ACCOUNT', 'account');
define('TB_PARTICULAR', 'particular');
define('TB_PARTICULAR_DETAIL', 'particular_detail');
define('CREADTED_AT', 'created_at'); // Customer Name
define('LAST_BACKUP_FILE_NAME', 'last_backup_file_name'); // Last Backup File Name
define('LAST_BACKUP_DATE', 'last_backup_date'); // Last Backup Date
define('BACKUP_ID', 'backup_id'); // Backup Id
define('USER_INR_ID', 'id'); // User Increment Id
define('USERNAME', 'name'); // User Name
define('EMAIL', 'email'); // Email
define('PASSWORD', 'password'); // Password
define('PRODUCT_INR_ID', 'product_inr_id'); // Product Increment Id
define('PRODUCT_INR_ID_MODAL', 'product_inr_id_modal'); // Product Increment Id Modal
define('PRODUCT_CODE', 'product_code'); // Product Code
define('PRODUCT_NAME', 'product_name'); // Product Name
define('PRODUCT_NAME_MODAL', 'product_name_modal'); // Product Name Modal
define('PRICE_1', 'price_1'); // Price 1
define('PRICE_2', 'price_2'); // Price 2
define('PRICE_3', 'price_3'); // Price 3
define('PURCHASE_INR_ID', 'purchase_inr_id'); // Purchase Increment Id
define('INVOICE_INR_ID', 'invoice_inr_id'); // Invoice Increment Id
define('QUANTITY', 'quantity'); // Quantity
define('ACCOUNT_INR_ID', 'account_inr_id');
define('DEBIt_AMOUNT', 'debit_amount');
define('CREDIT_AMOUNT', 'credit_amount');
define('CUSTOMER_AMOUNT', 'customer_amount'); // Customer Amount
define('BALANCE_AMOUNT', 'balance_amount'); // Balance Amount
define('FINAL_AMOUNT', 'final_amount'); // Amount after discount
define('TOTAL_AMOUNT', 'total_amount'); // Total Amount
define('AMOUNT', 'amount'); // Amount
define('PKT', 'pkt'); // Amount
define('RATE', 'rate'); // Rate
define('RECEIPT', 'receipt'); // Receipt
define('BILL_NUMBER', 'bill_number'); // Bill Number
define('BILL_NAME', 'bill_name'); // Bill Name
define('DISCOUNT', 'discount'); // Discount
define('DISCOUNT_IN_PERCENTAGE', 'discount_in_percentage'); // Discount
define('DISCOUNT_AMOUNT', 'discount_amount'); // Discount Amount
define('DATE_PICKER', 'date_picker'); // Date
define('DATE_PICKER_MODAL', 'date_picker_modal'); // Date Modal
define('STOCK', 'stock'); // Stock
define('STOCK_INR_ID', 'stock_inr_id'); // Stock Increment Id
define('UPLOAD', 'upload'); // Upload
define('PARTICULAR_INR_ID', 'particular_inr_id'); // Particular Increment Id
define('PARTICULAR_AMOUNT', 'particular_amount'); // Particular Amount
define('PARTICULAR_COUNT', 'particular_count'); // Particular Count
define('CASE_COUNT', 'case_count'); // Case Count
define('TAX_AMOUNT', 'tax_amount'); // Tax Amount
define('PACKING_AMOUNT', 'packing_amount'); // Packing Amount
define('COMPANY_NAME_MODAL', 'company_name_modal'); // Company Name Modal
define('CUSTOMER_NAME_MODAL', 'customer_name_modal'); // Customer Name Modal
define('CUSTOMER_INR_ID', 'customer_inr_id'); // Customer Increment Id
define('COMPANY_INR_ID', 'company_inr_id'); // Company Increment Id
define('CUSTOMER_NAME', 'customer_name'); // Customer Name
define('CUSTOMER_ADDRESS', 'customer_address'); // Customer Address
define('CUSTOMER_GST', 'customer_gst'); // Customer GST
define('COMPANY_NAME', 'company_name'); // Company Name
define('TRANSPORT_NAME', 'transport_name'); // Transport Name
define('COMPANY_ADDRESS', 'company_address'); // Company Address
define('COMPANY_GST', 'company_gst'); // Company GST
define('MOBILE', 'mobile'); // Customer Mobile
define('ISSHOW', 'is_show'); // Customer Address
define('TAG_SUBMIT_BUTTON', 'submit_button'); // Submit Button
define('DOWNLOAD_BUTTON', 'download_button'); // Download Button
define('PRODUCT_COUNT', 'product_count'); // Packing Amount
define('ARRAY_USER', 'user_collection'); // Array User
define('ARRAY_PARTICULAR', 'particular_collection'); // Array Particular
define('ARRAY_PRODUCT', 'product_collection'); // Array Product
define('ARRAY_PURCHASE', 'purchase_collection'); // Array Purchase
define('ARRAY_INVOICE', 'invoice_collection'); // Array Invoice
define('ARRAY_CUSTOMER', 'customer_collection'); // Array Customer
define('ARRAY_COMPANY', 'company_collection'); // Array Company
define('ARRAY_ACCOUNT', 'account_collection'); // Array Account


//***************************************** Path Variables ***********************************//

define('PATH_TEMPLATE_FOLDER', '/template');
define('PATH_PRODUCT_TEMPLATE', '/template/product_template.xlsx');
define('FILE_NAME_PRODUCT_TEMPLATE', 'product_template.xlsx');
define('PATH_PURCHASE_TEMPLATE', '/template/purchase_template.xlsx');
define('FILE_NAME_PURCHASE_TEMPLATE', 'purchase_template.xlsx');

//********************************** Database Return variables ******************************************//

define('RECORD_INSERTED', 1);
define('RECORD_NOT_INSERTED', 0);
define('RECORD_DELETED', 1);
define('RECORD_UPDATED', 1);
define('ASCENDING', 'asc');
define('DESCENDING', 'desc');

//********************************** Number variables ***************************************************//

define('MINUS_ONE', -1);
define('ZERO', 0);
define('ONE', 1);
define('TWO', 2);
define('THREE', 3);
define('FOUR', 4);
define('FIVE', 5);
define('SIX', 6);
define('SEVEN', 7);
define('EIGHT', 8);
define('NINE', 9);
define('TEN', 10);

//********************************** General variables *************************************************//

define('SUCCESS', true);
define('FAILURE', false);
define('SUCCESS_MESSAGE', 'success');
define('FAILURE_MESSAGE', 'failure');

define('SERIAL_NUMBER', 'serial_number');
define('COLON', ':');
define('SPLASH', '/');
define('HYPEN', '-');
define('SPACE', ' ');
define('ZERO_ZERO', '00');

define('EXTENSION_CSV', 'csv');
define('EXTENSION_EXCEL', 'xlsx');

define('EMPTY_STRING', '');


// User

Route::get('view_add_user', ['as' => 'tag_view_add_user', 'uses' => 'Controller_User@fun_view_add_user']);
Route::post('store_user',  ['as' => 'tag_store_user',    'uses' => 'Controller_User@fun_store_user']);
Route::get('view_all_user',  ['as' => 'tag_view_all_user', 'uses' => 'Controller_User@fun_view_all_user']);
Route::get('delete_user' . '/{' . USER_INR_ID . '}',      ['as' => 'tag_delete_user',       'uses' => 'Controller_User@fun_delete_user']);
Route::post('update_user/{' . USER_INR_ID . '}',         ['as' => 'tag_update_user',       'uses' => 'Controller_User@fun_update_user']);


// Customer

Route::get('view_add_customer', ['as' => 'tag_view_add_customer', 'uses' => 'Controller_Customer@fun_view_add_customer']);
Route::post('store_customer',  ['as' => 'tag_store_customer',    'uses' => 'Controller_Customer@fun_store_customer']);
Route::get('view_all_customer',  ['as' => 'tag_view_all_customer', 'uses' => 'Controller_Customer@fun_view_all_customer']);
Route::get('delete_customer' . '/{' . CUSTOMER_INR_ID . '}',      ['as' => 'tag_delete_customer',       'uses' => 'Controller_Customer@fun_delete_customer']);
Route::get('view_update_customer' . '/{' . CUSTOMER_INR_ID . '}', ['as' => 'tag_view_update_customer',  'uses' => 'Controller_Customer@fun_view_update_customer']);
Route::post('update_customer/{' . CUSTOMER_INR_ID . '}',         ['as' => 'tag_update_customer',       'uses' => 'Controller_Customer@fun_update_customer']);


// Company

Route::get('view_add_company', ['as' => 'tag_view_add_company', 'uses' => 'Controller_Company@fun_view_add_company']);
Route::post('store_company',  ['as' => 'tag_store_company',    'uses' => 'Controller_Company@fun_store_company']);
Route::get('view_all_company',  ['as' => 'tag_view_all_company', 'uses' => 'Controller_Company@fun_view_all_company']);
Route::get('delete_company' . '/{' . COMPANY_INR_ID . '}',      ['as' => 'tag_delete_company',       'uses' => 'Controller_Company@fun_delete_company']);
Route::get('view_update_company' . '/{' . COMPANY_INR_ID . '}', ['as' => 'tag_view_update_company',  'uses' => 'Controller_Company@fun_view_update_company']);
Route::post('update_company/{' . COMPANY_INR_ID . '}',         ['as' => 'tag_update_company',       'uses' => 'Controller_Company@fun_update_company']);

// Product
Route::get('view_add_product', ['as' => 'tag_view_add_product', 'uses' => 'Controller_Product@fun_view_add_product']);
Route::post('store_product',  ['as' => 'tag_store_product',    'uses' => 'Controller_Product@fun_store_product']);
Route::get('delete_product' . '/{' . PRODUCT_INR_ID . '}',      ['as' => 'tag_delete_product',       'uses' => 'Controller_Product@fun_delete_product']);
Route::post('update_product',         ['as' => 'tag_update_product',       'uses' => 'Controller_Product@fun_update_product']);


// Particular

Route::post('view_add_particular', ['as' => 'tag_view_add_particular', 'uses' => 'Controller_Particular@fun_view_add_particular']);
Route::get('view_add_particular_with_parameter/{' . CUSTOMER_INR_ID . '}',         ['as' => 'tag_view_add_particular_with_parameter',       'uses' => 'Controller_Particular@fun_view_add_particular_with_parameter']);
Route::post('store_particular',  ['as' => 'tag_store_particular',    'uses' => 'Controller_Particular@fun_store_particular']);
Route::get('view_all_particular',  ['as' => 'tag_view_all_particular', 'uses' => 'Controller_Particular@fun_view_all_particular']);
Route::get('view_single_particular' . '/{' . PARTICULAR_INR_ID . '}',       ['as' => 'tag_view_single_particular',        'uses' => 'Controller_Particular@fun_view_single_particular']);
Route::get('delete_particular' . '/{' . PARTICULAR_INR_ID . '}',      ['as' => 'tag_delete_particular',       'uses' => 'Controller_Particular@fun_delete_particular']);
Route::get('view_update_particular' . '/{' . PARTICULAR_INR_ID . '}', ['as' => 'tag_view_update_particular',  'uses' => 'Controller_Particular@fun_view_update_particular']);
Route::post('update_particular',         ['as' => 'tag_update_particular',       'uses' => 'Controller_Particular@fun_update_particular']);
Route::post('upload_receipt',         ['as' => 'tag_upload_receipt',       'uses' => 'Controller_Particular@fun_upload_receipt']);

// Credit

Route::get('view_add_credit', ['as' => 'tag_view_add_credit', 'uses' => 'Controller_Credit@fun_view_add_credit']);
Route::post('store_credit',  ['as' => 'tag_store_credit',    'uses' => 'Controller_Credit@fun_store_credit']);
Route::get('delete_credit' . '/{' . ACCOUNT_INR_ID . '}',      ['as' => 'tag_delete_credit',       'uses' => 'Controller_Credit@fun_delete_credit']);

// Print

Route::get('print_invoice_pdf' . '/{' . INVOICE_INR_ID . '}',       ['as' => 'tag_print_invoice_pdf',        'uses' => 'Controller_Print@fun_print_invoice']);
Route::get('print_account_pdf' . '/{' . CUSTOMER_INR_ID . '}',       ['as' => 'tag_print_account_pdf',        'uses' => 'Controller_Print@fun_print_account']);
Route::get('print_account_with_company_pdf' . '/{' . COMPANY_INR_ID . '}',       ['as' => 'tag_print_account_with_companypdf',        'uses' => 'Controller_Print@fun_print_account_with_company']);
Route::post('print_account_with_company_customer_pdf',  ['as' => 'tag_print_account_with_company_customer_pdf',    'uses' => 'Controller_Print@fun_print_account_with_company_customer']);
Route::get('print_particular_pdf' . '/{' . PARTICULAR_INR_ID . '}',       ['as' => 'tag_print_particular_pdf',        'uses' => 'Controller_Print@fun_print_particular']);

//********************************** Reset Semester page Controller ***********************************************//

Route::get('view_reset_year',  ['as' => 'tag_view_reset_year',   'uses' => 'Controller_Reset@fun_view_reset_year']);
Route::get('store_reset_year', ['as' => 'tag_store_reset_year',  'uses' => 'Controller_Reset@fun_store_reset_year']);

Route::get('/', ['as' => 'tag_homepage',  'uses' => 'HomeController@index']);

/*Route::get('/', function () {
    return view('welcome');
})->middleware(['auth']);*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
