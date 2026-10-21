<?php
declare(strict_types=1);

return [
    'title' => 'Length of Longest Fibonacci Subsequence: DP on the last pair',
    'leetcode' => 873,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the last two numbers fix the sequence, so dp[i][j] extends dp[k][i] where arr[k] = arr[j] − arr[i] is found with an index map. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'length-of-longest-fibonacci-subsequence',
    'tags' => ['dynamic-programming', 'hash-table', 'arrays', 'step-by-step'],
];
