<?php
declare(strict_types=1);

return [
    'title' => 'Longest Subsequence With Non-Increasing Differences',
    'leetcode' => 3409,
    'difficulty' => 'Med',
    'summary' => 'dp[i][d] = longest valid subsequence ending at i whose last difference is d. Extending from j with difference d needs the previous last difference ≥ d: dp[i][d] = 1 + max(1, best dp[j][d′ ≥ d]) (a suffix max over d′).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-subsequence-with-decreasing-adjacent-difference',
    'related_session' => 'longest-subsequence-with-decreasing-adjacent-difference',
];
