<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Exception;

class DatabaseBackUp extends Command
{
    protected $signature = 'database:backup';
    protected $description = 'Take DB Dump into storage/app/backup folder';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $db_collection = DB::table(TB_DB_BACKUP)->get();
            if (!empty($db_collection) && $db_collection->count() > 0) { // Every Day Backup
                $currentDate = Carbon::now()->format('d_m_Y');
                $backupFileName = "db_backup_daily_" . Carbon::now()->format('d_m_Y_H_i_s') . ".sql";
                $last_backup_date = DB::table(TB_DB_BACKUP)->where(BACKUP_ID, '1')->pluck(LAST_BACKUP_DATE)->first();
                if (!($currentDate == $last_backup_date)) {
                    $command = env('MYSQL_DUMP_PATH') . " --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "> " . storage_path() . "/app/db_backup/daily/" . $backupFileName;
                    $returnVar = NULL;
                    $output  = NULL;
                    exec($command, $output, $returnVar);
                    DB::table(TB_DB_BACKUP)->where(BACKUP_ID, '1')->update([
                        LAST_BACKUP_FILE_NAME   => $backupFileName,
                        LAST_BACKUP_DATE => $currentDate
                    ]);
                }
            } else { //first time backup
                $currentDate = Carbon::now()->format('d_m_Y');
                $backupFileName = "db_backup_daily_" . Carbon::now()->format('d_m_Y_H_i_s') . ".sql";
                $command = env('MYSQL_DUMP_PATH') . " --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "> " . storage_path() . "/app/db_backup/daily/" . $backupFileName;
                $returnVar = NULL;
                $output  = NULL;
                exec($command, $output, $returnVar);
                DB::table(TB_DB_BACKUP)->insertGetId([
                    LAST_BACKUP_FILE_NAME   => $backupFileName,
                    LAST_BACKUP_DATE => $currentDate
                ]);
            }
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
