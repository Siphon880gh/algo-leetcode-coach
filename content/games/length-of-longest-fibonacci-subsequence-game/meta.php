<?php
declare(strict_types=1);

return [
    'title' => 'Longest Fibonacci Subsequence: extend pairs (i, j) to k',
    'leetcode' => 873,
    'difficulty' => 'Med',
    'summary' => 'dp[j][k] = length of the Fibonacci-like sequence ending with arr[j], arr[k]. If arr[k] − arr[j] = arr[i] for some i < j, dp[j][k] = dp[i][j] + 1 (pairs start at 2).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'length-of-longest-fibonacci-subsequence',
    'related_session' => 'length-of-longest-fibonacci-subsequence',
];
