<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Movie\Movie;
use Movie\MovieDataProviderRest;

final class MovieTest extends TestCase
{
    public function testDataPresent() : void
    {
        $movie = new Movie(new MovieDataProviderRest('https://pastebin.com/raw/cVyp3McN'));

        $this->assertEquals(true, is_array($movie->getRecomendations('animation', '12:00')));
    }
}