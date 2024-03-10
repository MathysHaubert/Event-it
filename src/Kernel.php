<?php

declare(strict_types=1);

namespace App\Kernel;

use Exception;

class Kernel
{
    /**
     * Log an error message to the app.log file
     *
     * @param string $message
     * @return void
     */
    public static function logger(string $message): void
    {
        $time = '['.date('Y-m-d H:i:s').'] ';
        error_log($time . $message . "\n", 3, LOG_FILE);
    }

    /**
     * Create the log file if it doesn't exist
     *
     * @return void
     */
    public static function manageLogFile(): void
    {
        if (file_exists(LOG_FILE)) {
            // do nothing;
        } else if (file_exists(ROOT . '/var/log')) {
            // create app.log
            fopen(LOG_FILE, 'w');
        } else if (file_exists(ROOT . '/var')) {
            // create /log/app.log
            mkdir(ROOT . '/log', 0777, true);
        } else {
            // create /var/log/app.log
            mkdir(ROOT . '/var/log/app.log', 0777, true);
        }
    }
}