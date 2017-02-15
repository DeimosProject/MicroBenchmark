<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

class Example
{
    public $data = [
        __LINE__,
        __LINE__,
        __LINE__,
        __LINE__,
    ];

    public function __construct()
    {
        $this->data[] = microtime();
    }
}
class Example2 extends Example
{
    public $data2 = [
        __LINE__,
        __LINE__,
        __LINE__,
        __LINE__,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->data2 = array_merge($this->data, $this->data2);
    }
}
class Example3 extends Example2
{
    public $data3 = [
        __LINE__,
        __LINE__,
        __LINE__,
        __LINE__,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->data3 = array_merge($this->data2, $this->data3);
    }
}

function example() {
    new Example3();
}

$bm = \Deimos\MicroBenchmark\Benchmark::test(10000, function () {
    example();
});

var_dump($bm);
