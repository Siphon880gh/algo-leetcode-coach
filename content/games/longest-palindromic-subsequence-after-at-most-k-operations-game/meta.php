<?php
declare(strict_types=1);

return [
    'title' => 'Longest Palindromic Subsequence After at Most K Operations',
    'leetcode' => 3472,
    'difficulty' => 'Med',
    'summary' => 'Interval DP with a budget: dp[i][j][k]. Either drop s[i] or s[j], or pair them at cost min(|a − b|, 26 − |a − b|) and add 2 + dp[i+1][j−1][k − cost].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-palindromic-subsequence-after-at-most-k-operations',
    'related_session' => 'longest-palindromic-subsequence-after-at-most-k-operations',
];
