<?php

namespace App\Support;

class Phone
{
    /** Normalise Ghana numbers to +233XXXXXXXXX; returns null for empty input. */
    public static function normalize(?string $phone): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $phone);
        if ($digits === '') {
            return null;
        }
        if (str_starts_with($digits, '233')) {
            return '+' . $digits;
        }
        if (str_starts_with($digits, '0')) {
            return '+233' . substr($digits, 1);
        }
        return '+' . $digits;
    }
}
