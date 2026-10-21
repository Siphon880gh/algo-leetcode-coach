<?php
declare(strict_types=1);

return [
    'title' => 'Number of Orders in the Backlog: two heaps of batches',
    'leetcode' => 1801,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: buy batches in a max-heap, sell batches in a min-heap; match a new batch against the best opposite batches while prices cross, partially consuming amounts; push any remainder. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'number-of-orders-in-the-backlog',
    'tags' => ['heap', 'simulation', 'step-by-step'],
];
