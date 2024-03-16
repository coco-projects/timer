<?php

    use Coco\timer\Timer;

    require '../vendor/autoload.php';

    $timer = new Timer();

    $timer->start();

    $timer->mark('a');
    sleep(1);

    $timer->mark('b');
    sleep(1);

    $timer->mark('c');
    sleep(1);

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



