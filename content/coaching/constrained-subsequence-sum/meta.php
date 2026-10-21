<?php
declare(strict_types=1);

return [
    'title' => 'Constrained Subsequence Sum: dp with a monotonic deque',
    'leetcode' => 1425,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i] = nums[i] + max(0, max dp[j] for j in [i−k, i−1]). Keep a deque of indices with decreasing dp to get that window max in O(1). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'constrained-subsequence-sum',
    'tags' => ['dynamic-programming', 'monotonic-queue', 'sliding-window', 'step-by-step'],
];
