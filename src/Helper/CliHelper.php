<?php

namespace SudokuPhp\Helper;

class CliHelper
{
    public static function isCli(): bool
    {
        if (defined('STDIN')) {
            return true;
        }

        if (empty($_SERVER['REMOTE_ADDR']) && !isset($_SERVER['HTTP_USER_AGENT']) && count($_SERVER['argv']) > 0) {
            return true;
        }

        return false;
    }
}
