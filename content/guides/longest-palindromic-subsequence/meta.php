<?php
declare(strict_types=1);

return [
    'title' => 'Longest Palindromic Subsequence: interval DP on the two ends',
    'leetcode' => 516,
    'difficulty' => 'Med',
    'summary' => 'f[i][j] = longest palindromic subsequence in s[i..j]. Matching ends: f[i + 1][j − 1] + 2. Else max(f[i + 1][j], f[i][j − 1]). f[i][i] = 1. Fill i from the end. "bbbab" → 4. "cbbd" → 2. A subsequence, not a substring like 5. Equal to the LCS of s and its reverse.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'interval-dp', 'leetcode'],
    'related_session' => 'longest-palindromic-subsequence',
];
