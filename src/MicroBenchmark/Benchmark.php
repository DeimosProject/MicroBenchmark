<?php

namespace Deimos\MicroBenchmark;

class Benchmark
{
    /**
     * @param          $iterations
     * @param callable $callback
     *
     * @return BenchmarkResult
     */
    public static function test($iterations, callable $callback)
    {
        $i = 0;
        $memory = \memory_get_usage();
        $time = \microtime(true);
        while ($i < $iterations)
        {
            $callback();
            $i++;
        }
        $stopTime = \microtime(true);
        $stopMemory = \memory_get_usage();
        $stopMemoryReal = \memory_get_usage(true);
        $stopMemoryPeak = \memory_get_peak_usage();

        return new BenchmarkResult([
            'start' => $time,
            'stop' => $stopTime,
            'execution' => $stopTime - $time,
        ], [
            'usage' => $stopMemory - $memory,
            'realUsage' => $stopMemoryReal,
            'peakUsage' => $stopMemoryPeak,
        ]);
    }
}
