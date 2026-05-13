<?php

namespace App\Support;

class SizeConverter
{
    public static function toHumanReadable(int $bytes)
    {
        if ($bytes >= 1024 ** 3) {
            return number_format($bytes / (1024 ** 3)) . "GB";
        }

        if ($bytes >= 1024 ** 2) {
            return number_format($bytes / (1024 ** 2)) . "MB";
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 1) . " KB";
        }

        return "$bytes B";
    }
}
