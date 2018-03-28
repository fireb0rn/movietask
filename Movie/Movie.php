<?php

namespace Movie;

/**
 * Class Movie
 *
 * @package Movie
 */
class Movie
{
    //Minimum interval in seconds for recomendations
    const INTERVAL_MIN = 30;

    /**
     * @var \Movie\DataProviderInterface
     */
    private $dataProvider;

    /**
     * Movie constructor.
     *
     * @param \Movie\DataProviderInterface $dataProvider
     */
    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param $genre
     * @param $time
     *
     * @return array
     */
    public function getRecomendations($genre, $time) : array
    {
        $recommendations = [];

        $movies = $this->dataProvider->get();

        if (count($movies) > 0) {
            $date = date('Y-m-d');

            $dateTimeMovie = new \DateTime("{$date}T{$movies[0]['showings'][0]}");
            $dateTimeNow = new \DateTime("{$date}T{$time}:00", $dateTimeMovie->getTimezone());

            foreach ($movies as $movie) {
                foreach ($movie['genres'] as $movieGenre) {
                    if (mb_stristr($movieGenre, $genre)) {
                        $dateTimeMovie = new \DateTime("{$date}T{$movie['showings'][0]}");
                        $dateTimeInterval = $dateTimeNow->diff($dateTimeMovie);
                        $interval = $dateTimeInterval->h * 60 + $dateTimeInterval->i;

                        if ($dateTimeMovie > $dateTimeNow
                            && $interval >= self::INTERVAL_MIN)
                        {
                            $movie['dateTime'] = $dateTimeMovie;
                            $recommendations[] = $movie;
                        }
                    }
                }
            }

            if (count($recommendations) > 1) {
                uksort($recommendations, function($a, $b) {
                    return -($a['rating'] <=> $b['rating']);
                });
            }
        }

        return $recommendations;
    }
}