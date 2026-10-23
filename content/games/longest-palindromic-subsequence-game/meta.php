<?php
declare(strict_types=1);

return [
    'title' => 'Longest Palindromic Subsequence: match the ends or drop one',
    'leetcode' => 516,
    'difficulty' => 'Med',
    'summary' => 'dp[l][r]: if s[l] == s[r], 2 + dp[l+1][r−1]; else max(dp[l+1][r], dp[l][r−1]). Fill by increasing length.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-palindromic-subsequence',
    'related_session' => 'longest-palindromic-subsequence',
];
