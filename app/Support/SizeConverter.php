<?php

namespace App\Support;

class SizeConverter
{
    /**
     * @throws \Exception
     */
    public static function toKilobytes(string $size): int
    {
        $sizeLetter = strtolower(substr($size, -1, 1));
        $sizeInt = intval(substr($size, 0, -1));

        $multiplier = 1;

        if (!in_array($sizeLetter, ['k', 'm', 'g'])) {
            throw new \Exception("Size type of $sizeLetter is not supported");
        }

        if ($sizeLetter === 'm') {
            $multiplier = 1024 ** 2;
        }

        if ($sizeLetter === 'g') {
            $multiplier = 1024 ** 3;
        }

        return $sizeInt * $multiplier;
    }

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
