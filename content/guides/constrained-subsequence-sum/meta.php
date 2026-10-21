<?php
declare(strict_types=1);

return [
    'title' => 'Constrained Subsequence Sum: DP with a monotonic deque',
    'leetcode' => 1425,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = nums[i] + max(0, the best dp among the previous k indices). Keep a deque of indices with decreasing dp values so the window maximum is at the front.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'monotonic-queue', 'sliding-window', 'leetcode'],
    'related_session' => 'constrained-subsequence-sum',
];
