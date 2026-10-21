<?php
declare(strict_types=1);

return [
    'title' => 'Longest Subarray With Absolute Diff ≤ Limit: deques for max and min',
    'leetcode' => 1438,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: slide a window with a decreasing deque (max) and an increasing deque (min); shrink while max − min > limit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'longest-continuous-subarray-with-absolute-diff-less-than-or-equal-to-limit',
    'tags' => ['sliding-window', 'monotonic-queue', 'step-by-step'],
];
