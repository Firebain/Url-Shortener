<?php

namespace App\Services;

class Bijective
{
    private $_alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    public function __construct()
    {
        $this->_alphabet = str_split($this->_alphabet);
    }

    public function encode(int $i): string
    {
        if ($i == 0) {
            return $this->_alphabet[0];
        }

        $result = [];
        $base = count($this->_alphabet);

        while ($i > 0) {
            $result[] = $this->_alphabet[($i % $base)];
            $i = floor($i / $base);
        }

        $result = array_reverse($result);

        return join("", $result);
    }

    public function decode(string $input): int
    {
        $i = 0;
        $base = count($this->_alphabet);

        $input = str_split($input);

        foreach ($input as $char) {
            $pos = array_search($char, $this->_alphabet);

            $i = $i * $base + $pos;
        }

        return $i;
    }

    public function validate(string $input): bool
    {
        $input = str_split($input);

        foreach ($input as $char) {
            if (!in_array($char, $this->_alphabet)) {
                return false;
            }
        }

        return true;
    }
}