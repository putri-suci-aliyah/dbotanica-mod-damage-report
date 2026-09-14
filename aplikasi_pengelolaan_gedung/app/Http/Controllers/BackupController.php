<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    // FOR MYSQL
    // public function backup()
    // {
    //     $dbName = env('DB_DATABASE');
    //     $dbUser = env('DB_USERNAME');
    //     $dbPass = env('DB_PASSWORD');
    //     $dbHost = env('DB_HOST');

    //     // Path to save the backup
    //     $backupPath = storage_path('app/backups');
    //     if (!file_exists($backupPath)) {
    //         mkdir($backupPath, 0755, true);
    //     }

    //     // File name with timestamp
    //     $fileName = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
    //     $filePath = $backupPath . '/' . $fileName;

    //     // Construct mysqldump command (adjust for your environment)
    //     // Add --single-transaction for InnoDB tables consistency
    //     $command = "mysqldump --user={$dbUser} --password={$dbPass} --host={$dbHost} --single-transaction {$dbName} > {$filePath}";
        
    //     // Execute the command
    //     $returnVar = NULL;
    //     $output = NULL;
    //     exec($command, $output, $returnVar);

    //     if ($returnVar !== 0) {
    //         return back()->with('error', 'Backup failed!');
    //     }

    //     return response()->download($filePath)->deleteFileAfterSend(true);
    // }


    // FOR POSTGRES
    public function backup()
    {
        // DB_CONNECTION=pgsql
        // DB_HOST=127.0.0.1
        // DB_PORT=5432
        // DB_DATABASE=db_pengelolaan
        // DB_USERNAME=postgres
        // DB_PASSWORD=admin

        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');
        $dbHost = env('DB_HOST', '127.0.0.1');
        $dbPort = env('DB_PORT', '5432');

        echo $dbName;
        echo $dbUser;
        echo $dbPass;
        echo $dbHost;
        echo $dbPort;
        

        $backupPath = storage_path('app/backups');
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $fileName = 'backup-' . date('Y-m-d_H-i-s') . '.sql';
        $filePath = $backupPath . '/' . $fileName;

        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $tmpFile = storage_path('app/' . $filename);


        // Set the PGPASSWORD env var only for this command
        # $command = "PGPASSWORD=\"{$dbPass}\" pg_dump --host {$dbHost} --port {$dbPort} -U {$dbUser} -F p -f {$filePath} {$dbName}";
        $command = "PGPASSWORD=\"$dbPass\" pg_dump --host=$dbHost --port=$dbPort --username=$dbUser --format=plain --no-owner --no-acl $dbName > $tmpFile";

        // Execute the command
        $output = null;
        $returnVar = null;
        exec($command, $output, $returnVar);

        echo "-------------------------";
        echo $returnVar;
        echo "-------------------------";
        if ($returnVar !== 0) {
            dd();
            return back()->with('error', 'Database backup failed!');
        }
        dd();
        // Return file as download and delete it after send
        # return response()->download($filePath)->deleteFileAfterSend(true);
        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/sql',
        ]);
    }

}
