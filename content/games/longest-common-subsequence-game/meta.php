<?php
declare(strict_types=1);

return [
    'title' => 'Longest Common Subsequence: diagonal on a match',
    'leetcode' => 1143,
    'difficulty' => 'Med',
    'summary' => 'Compare text1[i−1] and text2[j−1]. Match: dp[i−1][j−1] + 1 (take both). Mismatch: max(dp[i−1][j], dp[i][j−1]) (drop one char from either string).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-common-subsequence',
    'related_session' => 'longest-common-subsequence',
];
