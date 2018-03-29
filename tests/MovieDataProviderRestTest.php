<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Movie\MovieDataProviderRest;

final class MovieDataProviderRestTest extends TestCase
{
    public function testIsDataArray() : void
    {
        $dataProvider = new MovieDataProviderRest('https://pastebin.com/raw/cVyp3McN');

        $this->assertEquals(true, is_array($dataProvider->get()));
    }
}