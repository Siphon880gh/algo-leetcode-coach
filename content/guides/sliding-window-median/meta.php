<?php
declare(strict_types=1);

return [
    'title' => 'Sliding Window Median: two heaps with lazy deletion',
    'leetcode' => 480,
    'difficulty' => 'Hard',
    'summary' => 'Median of every window of size k. Keep a max-heap of the smaller half and a min-heap of the larger half, balanced so small has k/2 rounded up. Add the incoming value, mark the outgoing one in a delayed map, rebalance, and pop delayed values when they reach a heap top. [1,3,−1,−3,5,3,6,7], k = 3 → [1,−1,−1,3,5,6]. Not 295.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'sliding-window', 'hash-table', 'leetcode'],
    'related_session' => 'sliding-window-median',
];
