<?php
declare(strict_types=1);

return [
    'title' => 'Count Different Palindromic Subsequences: handle equal ends carefully',
    'leetcode' => 730,
    'difficulty' => 'Hard',
    'summary' => 'If s[i] not equal to s[j]: dp[i+1][j] + dp[i][j−1] − dp[i+1][j−1]. If equal, find the next equal letters inside: none gives 2 times inner + 2; one gives 2 times inner + 1; two or more gives 2 times inner − dp between them.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-different-palindromic-subsequences',
    'related_session' => 'count-different-palindromic-subsequences',
];
