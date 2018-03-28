<?php

require_once 'autoload.php';

use \Movie\Movie;
use \Movie\MovieDataProviderRest;

if (count($argv) < 3) {
    $fileName = mb_substr($argv[0], 2);
    $executeName = mb_strpos($fileName, '.php') > 0 ? "php $fileName" : $fileName;
    echo "Usage: $executeName <genre> <time>\n";
    exit;
}

$genre = $argv[1];
$time = $argv[2];

$movie = new Movie(new MovieDataProviderRest('https://pastebin.com/raw/cVyp3McN'));
$recomendations = $movie->getRecomendations($genre, $time);

if (count($recomendations)) {
    foreach ($recomendations as $movie) {
        echo "{$movie['name']}, showing at " . $movie['dateTime']->format('ga') . "\n";
    }
} else {
    echo "No movie recommendations.\n";
    exit;
}



