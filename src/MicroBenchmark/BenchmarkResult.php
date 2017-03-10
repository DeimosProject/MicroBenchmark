<?php

namespace Deimos\MicroBenchmark;

class BenchmarkResult
{
    /**
     * @var array
     */
    protected $time = [];

    /**
     * @var array
     */
    protected $memory = [];

    /**
     * @var \Throwable
     */
    protected $debug;

    /**
     * BenchmarkResult constructor
     *
     * @param array           $time
     * @param array           $memory
     * @param null|\Throwable $debug
     */
    public function __construct(array $time, array $memory, $debug = null)
    {
        $this->time   = $time;
        $this->memory = $memory;

        $this->debug = $debug;
    }

    protected function traceDebug()
    {
        return $this->debug instanceof \Throwable ? [
            'message' => $this->debug->getMessage(),
            'code' => $this->debug->getCode(),
            'trace' => $this->debug->getTraceAsString(),
            'file' => $this->debug->getFile(),
            'line' => $this->debug->getLine(),
        ] : null;
    }

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
     * @return null|\Throwable
     */
    public function debug()
    {
        return $this->debug;
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
            'debug' => $this->traceDebug()
        ];
    }
}
