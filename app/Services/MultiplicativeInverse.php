<?php

namespace App\Services;

class MultiplicativeInverse
{
    private const MODULUS = 4_294_967_296; // Number of keys + 1. 2^32
    private const RANDOM = 387_420_489; // Random number. Must be coprime to $m

    private $mult_inv = null;

    public function __construct()
    {
        $this->mult_inv = Self::extended_euclidean_division(
            Self::RANDOM,
            Self::MODULUS
        )[0] % Self::MODULUS;
    }

    public function encode(int $i): int
    {
        return $i * Self::RANDOM % Self::MODULUS;
    }

    public function decode(int $input): int
    {
        return $input * $this->mult_inv % Self::MODULUS;
    }

    public function validate(int $i)
    {
        return $i < Self::MODULUS;
    }

    private static function extended_euclidean_division(int $a, int $b): array
    {
        if ($a < 0) {
            [$item1, $item2] = Self::extended_euclidean_division(-$a, $b);

            return [-$item1, $item2];
        }

        if ($b < 0) {
            [$item1, $item2] = Self::extended_euclidean_division($a, -$b);

            return [$item1, -$item2];
        }

        if ($b == 0) {
            return [1, 0];
        }

        $q = intval($a / $b);
        $r = intval($a % $b);
        [$s, $t] = Self::extended_euclidean_division($b, $r);

        return [intval($t), intval($s - $q * $t)];
    }
}