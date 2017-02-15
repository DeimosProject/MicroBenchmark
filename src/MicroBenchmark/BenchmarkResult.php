<?php

namespace Deimos\MicroBenchmark;

class BenchmarkResult
{
    /**
     * BenchmarkResult constructor
     *
     * @param array $time
     * @param array $memory
     */
    public function __construct(array $time, array $memory)
    {
        $this->time = $time;
        $this->memory = $memory;
    }

    /**
     * @var array
     */
    protected $time = [];

    /**
     * @var array
     */
    protected $memory = [];

    /**
     * @return array
     */
    public function time()
    {
        return $this->time;
    }

    /**
     * @return array
     */
    public function memory()
    {
        return $this->memory;
    }

    /**
     * @return array
     */
    public function extensions()
    {
        return \get_loaded_extensions();
    }

    public function __debugInfo()
    {
        return [
            'memory' => $this->memory(),
            'time' => $this->time(),
        ];
    }
}
