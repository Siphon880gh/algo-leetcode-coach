<?php
declare(strict_types=1);

return [
    'title' => 'Sum of K Subarrays With Length at Least M: k layers',
    'leetcode' => 3473,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[j][i] with a running best of dp[j − 1][t] − pre[t]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'sum-of-k-subarrays-with-length-at-least-m',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'step-by-step'],
];
