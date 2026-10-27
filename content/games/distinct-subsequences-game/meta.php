<?php
declare(strict_types=1);

return [
    'title' => 'Distinct Subsequences: use this letter or skip it',
    'leetcode' => 115,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = ways to form t[0 to j) from s[0 to i). Skipping s[i−1] always gives dp[i−1][j]; if s[i−1] == t[j−1], also add dp[i−1][j−1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'distinct-subsequences',
    'related_session' => 'distinct-subsequences',
];
