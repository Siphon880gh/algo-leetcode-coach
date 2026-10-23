<?php
declare(strict_types=1);

return [
    'title' => 'Longest Arithmetic Subsequence: one map per index',
    'leetcode' => 1027,
    'difficulty' => 'Med',
    'summary' => 'dp[i][d] = length of the longest arithmetic subsequence ending at i with difference d = dp[j][d] + 1 for j < i (2 if new).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-arithmetic-subsequence',
    'related_session' => 'longest-arithmetic-subsequence',
];
