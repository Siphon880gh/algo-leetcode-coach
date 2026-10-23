<?php
declare(strict_types=1);

return [
    'title' => 'Count Different Palindromic Subsequences: handle equal ends carefully',
    'leetcode' => 730,
    'difficulty' => 'Hard',
    'summary' => 'If s[i] ≠ s[j]: dp[i+1][j] + dp[i][j−1] − dp[i+1][j−1]. If equal, find the next equal letters inside: none → 2·inner + 2, one → 2·inner + 1, two or more → 2·inner − dp between them.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-different-palindromic-subsequences',
    'related_session' => 'count-different-palindromic-subsequences',
];
