<?php

declare(strict_types=1);

namespace App\Kernel;

class Kernel
{
    public static function logger($message)
    {
        $time = '['.date('Y-m-d H:i:s').'] ';
        error_log($time . $message . "\n", 3, LOG_FILE);
    }
}