<?php
declare(strict_types=1);

return [
    'title' => 'Count Partitions With Max-Min Difference at Most K: windowed DP sums',
    'leetcode' => 3578,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = ways to split the first i elements. The segments that can end at i start at or after l, the smallest start with max − min ≤ k; monotonic deques track l, and prefix sums of dp give dp[i + 1] = dp[l] + … + dp[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['queue', 'array', 'dynamic-programming', 'prefix-sum', 'sliding-window', 'monotonic-queue', 'leetcode'],
    'related_session' => 'count-partitions-with-max-min-difference-at-most-k',
];
