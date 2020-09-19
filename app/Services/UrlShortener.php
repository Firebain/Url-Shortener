<?php

namespace App\Services;

class UrlShortener
{
    private MultiplicativeInverse $mult_inv;
    private Bijective $bijective;

    public function __construct()
    {
        $this->mult_inv = new MultiplicativeInverse();
        $this->bijective = new Bijective();
    }

    public function encode(int $id): string
    {
        $obfuscated = $this->mult_inv->encode($id);

        return $this->bijective->encode($obfuscated);
    }

    public function decode(string $input): int
    {
        $obfuscated = $this->bijective->decode($input);

        return $this->mult_inv->decode($obfuscated);
    }

    public function validate(string $input): bool
    {
        if (!$this->bijective->validate($input)) {
            return false;
        }

        $obfuscated = $this->bijective->decode($input);

        return $this->mult_inv->validate($obfuscated);
    }
}