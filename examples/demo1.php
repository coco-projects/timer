<?php

    use Coco\timer\Timer;

    require '../vendor/autoload.php';

    $timer = new Timer();

    $timer->start();
    usleep(1000 * 500);

    $timer->mark('a');
    usleep(1000 * 500);

    $timer->mark('b');
    usleep(1000 * 500);

    $timer->mark('c');
    usleep(1000 * 500);

    $timer->mark('d');

    print_r($timer->markCompare('a', 'c'));
    echo PHP_EOL;

    print_r($timer->sinceStartTime('c'));
    echo PHP_EOL;

    print_r($timer->totalTime());
    echo PHP_EOL;

    print_r($timer->getMarkMemory('d'));
    echo PHP_EOL;

    print_r($timer->getMarkMemoryPeak('d'));
    echo PHP_EOL;

    print_r($timer->getTotalMemory());
    echo PHP_EOL;

    print_r($timer->getTotalMemoryPeak());
    echo PHP_EOL;

    print_r($timer->getReport());
    echo PHP_EOL;



