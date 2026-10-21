<?php
declare(strict_types=1);

return [
    'title' => 'Number of Orders in the Backlog: two heaps of batches',
    'leetcode' => 1801,
    'difficulty' => 'Med',
    'summary' => 'Keep buy batches in a max-heap by price and sell batches in a min-heap. Each new batch matches against the best opposite batches while prices cross, partially consuming amounts; any remainder joins its own heap.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'simulation', 'leetcode'],
    'related_session' => 'number-of-orders-in-the-backlog',
];
