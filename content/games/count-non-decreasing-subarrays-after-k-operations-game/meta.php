<?php
declare(strict_types=1);

return [
    'title' => 'Count Non-Decreasing Subarrays After K Operations',
    'leetcode' => 3420,
    'difficulty' => 'Hard',
    'summary' => 'Cost of a subarray = Σ (running max − nums[i]). Cost is monotone in window size, so two pointers work; a monotonic stack (or segment tree) maintains the cost as the window shrinks/grows.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-non-decreasing-subarrays-after-k-operations',
    'related_session' => 'count-non-decreasing-subarrays-after-k-operations',
];
