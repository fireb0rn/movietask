<?php

namespace Movie;

/**
 * Class DataProviderRest
 *
 * @package Movie
 */
class MovieDataProviderRest implements DataProviderInterface
{
    /**
     * @var string
     */
    protected $resource;

    /**
     * DataProviderRest constructor.
     *
     * @param string $resource
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return array
     */
    public function get() : array
    {
        return json_decode(file_get_contents($this->resource), true);
    }
}