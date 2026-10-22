<?php
declare(strict_types=1);

return [
    'title' => 'Count Non-Decreasing Subarrays After K Operations: two pointers with a block deque',
    'leetcode' => 3420,
    'difficulty' => 'Hard',
    'summary' => 'A subarray costs Σ (running max − element). Move the left end leftward; the cost can only grow, so the right end only shrinks. A deque of (running-max value, count) blocks updates the cost when either end moves.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['stack', 'segment-tree', 'queue', 'array', 'sliding-window', 'monotonic-queue', 'monotonic-stack', 'leetcode'],
    'related_session' => 'count-non-decreasing-subarrays-after-k-operations',
];
