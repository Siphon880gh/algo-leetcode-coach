<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum of M Non-Overlapping Subarrays I: layered DP with a sliding max',
    'leetcode' => 3956,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: one DP layer per subarray count, with a sliding max over allowed starts. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-sum-of-m-non-overlapping-subarrays-i',
    'tags' => ['queue', 'array', 'binary-search', 'dynamic-programming', 'prefix-sum', 'sliding-window', 'monotonic-queue', 'step-by-step'],
];
