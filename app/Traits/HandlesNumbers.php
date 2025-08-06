<?php

namespace App\Traits;

trait HandlesNumbers
{
    public function normalizeNumber($input): array|float|int|string
    {
        if (str_contains($input, '.') !== false) {
            return str_replace('.', '', $input);
        } else {
            return $input * 100;
        }
    }
}
