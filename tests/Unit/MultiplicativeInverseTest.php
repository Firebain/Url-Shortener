<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\MultiplicativeInverse;

class MultiplicativeInverseTest extends TestCase
{
    protected $mult_inv;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mult_inv = new MultiplicativeInverse();
    }

    /**
     * @dataProvider dataCases
     */
    public function testEncode($original, $obfuscated)
    {
        $this->assertEquals($this->mult_inv->encode($original), $obfuscated);
    }

    /**
     * @dataProvider dataCases
     */
    public function testDecode($original, $obfuscated)
    {
        $this->assertEquals($this->mult_inv->decode($obfuscated), $original);
    }

    public function dataCases()
    {
        return [
            [77, 4061573877],
            [1553, 368597977],
            [14217, 1809018641],
            [4256, 3889126816],
            [604356, 4049875940]
        ];
    }
}