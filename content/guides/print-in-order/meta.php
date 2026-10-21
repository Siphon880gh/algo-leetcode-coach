<?php
declare(strict_types=1);

return [
    'title' => 'Print in Order: two one-shot signals',
    'leetcode' => 1114,
    'difficulty' => 'Easy',
    'summary' => 'Thread two must wait for first to finish and thread three for second. Two events (or semaphores starting at 0) give exactly that ordering, whatever order the threads start in.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'kind' => 'algo',
    'tags' => ['concurrency', 'threads', 'leetcode'],
    'related_session' => 'print-in-order',
];
