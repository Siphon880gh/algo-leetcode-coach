<?php
declare(strict_types=1);

return [
    'title' => 'Arithmetic Slices II: count by (end, difference)',
    'leetcode' => 446,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][d] = arithmetic subsequences of length at least 2 ending at i with difference d. For each j < i: d = a[i] − a[j]; dp[j][d] of them become length at least 3 (count them), and dp[i][d] += dp[j][d] + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'arithmetic-slices-ii-subsequence',
    'related_session' => 'arithmetic-slices-ii-subsequence',
];
