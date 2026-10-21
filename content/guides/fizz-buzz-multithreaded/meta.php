<?php
declare(strict_types=1);

return [
    'title' => 'Fizz Buzz Multithreaded: one counter, one condition',
    'leetcode' => 1195,
    'difficulty' => 'Med',
    'summary' => 'Share a counter i under one condition variable. Each thread waits until i is past n or i belongs to it, prints, increments, and wakes everyone; all four exit once i passes n.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'kind' => 'algo',
    'tags' => ['concurrency', 'design', 'leetcode'],
    'related_session' => 'fizz-buzz-multithreaded',
];
