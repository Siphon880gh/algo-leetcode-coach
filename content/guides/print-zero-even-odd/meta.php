<?php
declare(strict_types=1);

return [
    'title' => 'Print Zero Even Odd: a zero thread that hands off by parity',
    'leetcode' => 1116,
    'difficulty' => 'Med',
    'summary' => 'Three threads print 0, even numbers, and odd numbers so the output reads 0 1 0 2 0 3 …. The zero thread holds the first turn and, after each 0, wakes the odd or even thread; that thread prints its number and gives the turn back.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'kind' => 'algo',
    'tags' => ['concurrency', 'threads', 'semaphore', 'leetcode'],
    'related_session' => 'print-zero-even-odd',
];
