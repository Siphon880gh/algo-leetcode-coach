<?php
declare(strict_types=1);

return [
    'title' => 'Longest Palindromic Subsequence II: interval DP with the outer letter',
    'leetcode' => 1682,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j][c] = longest good palindrome inside s[i..j] whose outer letter is not c. Matching ends s[i] = s[j] ≠ c extend an inner one whose outer letter is not s[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'string', 'leetcode'],
    'related_session' => 'longest-palindromic-subsequence-ii',
];
