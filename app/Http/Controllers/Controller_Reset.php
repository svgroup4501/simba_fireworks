<?php


namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Console\Command;
use App\Classes\Class_Database;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class Controller_Reset extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fun_view_reset_year()
    {
        return View('view_reset_year');
    }

    public function fun_store_reset_year()
    {
        $backupFileName = "db_backup_yearly_" . Carbon::now()->format('d_m_Y_H_i_s') . ".sql";
        $command = env('MYSQL_DUMP_PATH') . " --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "> " . storage_path() . "/app/db_backup/yearly/" . $backupFileName;
        $returnVar = NULL;
        $output  = NULL;
        exec($command, $output, $returnVar);

        DB::table(TB_CUSTOMER)->truncate();
        DB::table(TB_COMPANY)->truncate();
        DB::table(TB_ACCOUNT)->truncate();
        DB::table(TB_PARTICULAR)->truncate();
        DB::table(TB_PARTICULAR_DETAIL)->truncate();

        return Class_Database::return_FM_Success('Reset Successfully', '/');
    }
}
