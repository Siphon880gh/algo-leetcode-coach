<?php
declare(strict_types=1);

return [
    'title' => 'Wildcard Matching: "*" eats nothing or one more letter',
    'leetcode' => 44,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j]: does s[0 to i) match p[0 to j)? "?" or the same letter inherits dp[i−1][j−1]. "*" matches empty (dp[i][j−1]) or one more letter (dp[i−1][j]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'wildcard-matching',
    'related_session' => 'wildcard-matching',
];
