<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of K Consecutive Bit Flips: flip greedily, track active flips',
    'leetcode' => 995,
    'difficulty' => 'Hard',
    'summary' => 'Scan left to right. The leftmost 0 can only be fixed by a flip starting there, so start one when the current bit (after active flips) is 0. Track the active flip parity with a difference marker so each step is O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['greedy', 'sliding-window', 'bit-manipulation', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-number-of-k-consecutive-bit-flips',
];
