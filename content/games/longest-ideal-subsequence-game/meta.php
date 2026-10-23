<?php
declare(strict_types=1);

return [
    'title' => 'Longest Ideal Subsequence: best per letter',
    'leetcode' => 2370,
    'difficulty' => 'Med',
    'summary' => 'dp[c] = longest ideal subsequence ending in letter c. For a new letter c: dp[c] = 1 + max dp over letters within k of c.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-ideal-subsequence',
    'related_session' => 'longest-ideal-subsequence',
];
