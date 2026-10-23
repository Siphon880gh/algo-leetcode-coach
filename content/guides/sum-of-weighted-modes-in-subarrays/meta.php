<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Weighted Modes in Subarrays: sliding window with a heap',
    'leetcode' => 3672,
    'difficulty' => 'Med',
    'summary' => 'Slide a window of length k, keeping value counts and a heap of (−count, value) with lazy deletion. The top valid entry is the mode, smallest value on ties; add mode × count for every window.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'counting', 'ordered-set', 'sliding-window', 'leetcode'],
    'related_session' => 'sum-of-weighted-modes-in-subarrays',
];
