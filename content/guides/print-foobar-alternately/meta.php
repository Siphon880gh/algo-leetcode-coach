<?php
declare(strict_types=1);

return [
    'title' => 'Print FooBar Alternately: two semaphores pass the turn',
    'leetcode' => 1115,
    'difficulty' => 'Med',
    'summary' => 'One thread prints foo and the other bar, n times each, strictly alternating. Give foo a semaphore that starts open and bar one that starts closed; each thread waits on its own and opens the other\'s after printing.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'kind' => 'algo',
    'tags' => ['concurrency', 'threads', 'semaphore', 'leetcode'],
    'related_session' => 'print-foobar-alternately',
];
