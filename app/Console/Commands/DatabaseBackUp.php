<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $backupPath = storage_path('app/backup');
        $backupFile = $backupPath . '/' . $database . '_' . date('Y-m-d_H-i-s') . '.sql';

        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $process = new Process([
            'mysqldump',
            '--user=' . $username,
            '--password=' . $password,
            '--host=' . $host,
            $database,
            '--result-file=' . $backupFile,
        ]);

        try {
            $process->mustRun();
            $this->info('The backup has been completed successfully.');
        } catch (ProcessFailedException $exception) {
            $this->error('The backup process has failed.');
            $this->error($exception->getMessage());
        }

        return 0;
    }
}
