<?php
// Author: https://github.com/wdalmut
// Source: https://github.com/wdalmut/php-bijective

namespace App\Services;

class Bijective
{
    private $_alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    public function __construct()
    {
        $this->_alphabet = str_split($this->_alphabet);
    }

    /**
     * Encode ID
     * @param int $i
     * @return string The encoded value
     */
    public function encode($i)
    {
        if ($i == 0)
        return $this->_alphabet[0];

        $result = [];
        $base = count($this->_alphabet);

        while ($i > 0)
        {
            $result[] = $this->_alphabet[($i % $base)];
            $i = floor($i / $base);
        }

        $result = array_reverse($result);

        return join("", $result);
    }

    /**
     * Decode ID
     *
     * @param string $input
     * @return int
     */
    public function decode($input)
    {
        $i = 0;
        $base = count($this->_alphabet);

        $input = str_split($input);

        foreach($input as $char)
        {
            $pos = array_search($char, $this->_alphabet);

            $i = $i * $base + $pos;
        }

        return $i;
    }

    public function validate($input)
    {
        $input = str_split($input);

        foreach($input as $char)
        {
            if (!in_array($char, $this->_alphabet)) {
                return false;
            }
        }

        return true;
    }
}
