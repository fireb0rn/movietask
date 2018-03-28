<?php

namespace Movie;

/**
 * Interface DataProviderInterface
 *
 * @package Movie
 */
interface DataProviderInterface
{
    /**
     * DataProviderInterface constructor.
     *
     * @param $resource
     */
    public function __construct($resource);

    /**
     * @return array
     */
    public function get() : array;
}