<?php
declare(strict_types=1);

return [
    'title' => 'Design Bounded Blocking Queue: one lock, two conditions',
    'leetcode' => 1188,
    'difficulty' => 'Med',
    'summary' => 'Guard a deque with one lock and two condition variables. enqueue waits on not_full in a loop, dequeue waits on not_empty, and each signals the other condition after changing the queue.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'kind' => 'algo',
    'tags' => ['concurrency', 'design', 'queue', 'leetcode'],
    'related_session' => 'design-bounded-blocking-queue',
];
