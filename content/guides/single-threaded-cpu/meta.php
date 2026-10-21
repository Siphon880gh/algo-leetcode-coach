<?php
declare(strict_types=1);

return [
    'title' => 'Single-Threaded CPU: sort by arrival, heap by length',
    'leetcode' => 1834,
    'difficulty' => 'Med',
    'summary' => 'Sort task indices by enqueue time. Keep a min-heap of available tasks keyed by (processing time, index). When the heap is empty, jump time to the next arrival; otherwise pop, run it, and advance time.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'sorting', 'simulation', 'leetcode'],
    'related_session' => 'single-threaded-cpu',
];
