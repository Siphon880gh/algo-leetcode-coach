<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Integer After k Adjacent Swaps: greedy + BIT',
    'leetcode' => 1505,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: per digit queue of positions; pick the smallest digit whose current position (original − removed before it) ≤ k; bring it to the front. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-possible-integer-after-at-most-k-adjacent-swaps-on-digits',
    'tags' => ['greedy', 'fenwick-tree', 'strings', 'step-by-step'],
];
