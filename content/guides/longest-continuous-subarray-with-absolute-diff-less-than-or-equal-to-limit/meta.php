<?php
declare(strict_types=1);

return [
    'title' => 'Longest Continuous Subarray With Absolute Diff ≤ Limit: two monotonic deques',
    'leetcode' => 1438,
    'difficulty' => 'Med',
    'summary' => 'Slide a window, keeping a decreasing deque for the max and an increasing deque for the min. Shrink from the left while max − min exceeds the limit.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'monotonic-queue', 'leetcode'],
    'related_session' => 'longest-continuous-subarray-with-absolute-diff-less-than-or-equal-to-limit',
];
