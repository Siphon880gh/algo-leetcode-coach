<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of K Consecutive Bit Flips: greedy with a flip window',
    'leetcode' => 995,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: scan left to right, flip at i whenever the current bit (after active flips) is 0, and track active flips with a counter and end markers. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'minimum-number-of-k-consecutive-bit-flips',
    'tags' => ['greedy', 'sliding-window', 'bit-manipulation', 'prefix-sum', 'step-by-step'],
];
