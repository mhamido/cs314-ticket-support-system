<?php

// php tends to hide quite a lot of errors
// so these make most of them visible enough
// to debug.

declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


class DatabaseConnection extends mysqli
{
    private static $instance;

    private function __construct()
    {
        parent::__construct('localhost', 'root', '', 'phase2');
    }

    /**
     * @return DatabaseConnection
     */

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }
}
