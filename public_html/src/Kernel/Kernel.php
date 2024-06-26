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
    public static function logger(mixed $message): void
    {
        // error_log('teste');
        // $time = '['.date('Y-m-d H:i:s').'] ';
        // error_log($time . $message . "\n", 3, LOG_FILE);
    }

    /**
     * Create the log file if it doesn't exist
     *
     * @return void
     * @throws Exception
     */
    public static function manageLogFile(): void
    {
        try { if (file_exists(LOG_FILE)) {
                // do nothing;
                return;
            } else if (file_exists(ROOT . '/var/log')) {
                // create app.log
                fopen(LOG_FILE, 'w');
            } else if (file_exists(ROOT . '/var')) {
                // create /log/app.log
                mkdir(ROOT . '/log', 0774, true);
            } else {
                // create /var/log/app.log
                mkdir(ROOT . '/var/log/app.log', 0774, true);
            }
            if (!file_exists(LOG_FILE)) {
                throw new Exception('Could not create log file');
            }
        } catch (Exception $e) {
            throw new Exception('Could not create log file:'.$e->getMessage());
        }
    }
}
