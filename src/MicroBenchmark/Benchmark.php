<?php

namespace Deimos\MicroBenchmark;

class Benchmark
{

    /**
     * @param          $iterations
     * @param callable $callback
     *
     * @return BenchmarkResult
     *
     * @deprecated use task
     */
    public static function test($iterations, callable $callback)
    {
        return self::task($iterations, $callback);
    }

    /**
     * @param          $iterations
     * @param callable $callback
     *
     * @return BenchmarkResult
     */
    public static function task($iterations, callable $callback)
    {
        set_time_limit(0);

        $iterator = 0;
        $memory   = \memory_get_usage();
        $time     = \microtime(true);

        while ($iterator < $iterations)
        {
            $callback($iterator++);
        }

        $stopTime       = \microtime(true);
        $stopMemory     = \memory_get_usage();
        $stopMemoryReal = \memory_get_usage(true);
        $stopMemoryPeak = \memory_get_peak_usage();

        return new BenchmarkResult(
            [
                'start'     => $time,
                'stop'      => $stopTime,
                'execution' => $stopTime - $time,
            ],
            [
                'usage'     => $stopMemory - $memory,
                'realUsage' => $stopMemoryReal,
                'peakUsage' => $stopMemoryPeak,
            ]
        );
    }

}
