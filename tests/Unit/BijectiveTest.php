<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Bijective;

class BijectiveTest extends TestCase
{
    protected $bijective;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bijective = new Bijective();
    }

    /**
     * @dataProvider dataCases
     */
    public function testEncode($original, $encoded)
    {
        $this->assertEquals($this->bijective->encode($original), $encoded);
    }

    /**
     * @dataProvider dataCases
     */
    public function testDecode($original, $encoded)
    {
        $this->assertEquals($this->bijective->decode($encoded), $original);
    }

    public function dataCases()
    {
        return [
            [77, "bp"],
            [1553, "zd"],
            [14217, "dRt"],
            [4256, "bgO"],
            [604356, "cHnQ"]
        ];
    }
}