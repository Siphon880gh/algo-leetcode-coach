<?php
declare(strict_types=1);

return [
    'title' => 'Sliding Window Median: two heaps with lazy deletion',
    'leetcode' => 480,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: median of every window of size k. Max-heap for the lower half, min-heap for the upper; add the new value, mark the leaving one in a delayed map, rebalance, and pop delayed tops lazily. [1,3,−1,−3,5,3,6,7], k = 3 → [1,−1,−1,3,5,6]. Not 295. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'sliding-window', 'hash-table', 'step-by-step'],
    'related_guide' => 'sliding-window-median',
];
