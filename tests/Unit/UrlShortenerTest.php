<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Services\UrlShortener;

class UrlShortenerTest extends TestCase
{
    protected $url_shortener;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url_shortener = new UrlShortener();
    }

    /**
     * @dataProvider dataCases
     */
    public function testEncode($original, $encoded)
    {
        $this->assertEquals($this->url_shortener->encode($original), $encoded);
    }

    /**
     * @dataProvider dataCases
     */
    public function testDecode($original, $encoded)
    {
        $this->assertEquals($this->url_shortener->decode($encoded), $original);
    }

    public function dataCases()
    {
        return [
            [77, "eA164f"],
            [1553, "y6LkP"],
            [14217, "b8ACyb"],
            [4256, "epmxH2"],
            [604356, "eAe1TQ"]
        ];
    }
}