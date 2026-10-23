<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Subarray Length With Distinct Sum At Least K: sliding window',
    'leetcode' => 3795,
    'difficulty' => 'Med',
    'summary' => 'Values are positive, so growing a window never lowers its distinct sum. Grow on the right; while the sum is at least k, record the length and shrink from the left.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'sliding-window', 'leetcode'],
    'related_session' => 'minimum-subarray-length-with-distinct-sum-at-least-k',
];
