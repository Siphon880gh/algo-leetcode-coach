<?php
declare(strict_types=1);

return [
    'title' => 'Process Tasks Using Servers: two heaps with a clock',
    'leetcode' => 1882,
    'difficulty' => 'Med',
    'summary' => 'Free servers in a heap by (weight, index); busy servers in a heap by (free time, weight, index). For task j, the time is max(clock, j); if none is free, jump to the earliest free time. Release finished servers, then assign.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'simulation', 'leetcode'],
    'related_session' => 'process-tasks-using-servers',
];
