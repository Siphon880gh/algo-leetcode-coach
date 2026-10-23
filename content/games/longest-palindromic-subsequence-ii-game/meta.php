<?php
declare(strict_types=1);

return [
    'title' => 'Longest Palindromic Subsequence II: even length, no repeated neighbors',
    'leetcode' => 1682,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] = (length, outer letter) of the best good palindrome in s[i..j]. If s[i] == s[j] and differs from the inner best\'s outer letter, wrap it: length + 2. Otherwise take the better of dropping either end.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-palindromic-subsequence-ii',
    'related_session' => 'longest-palindromic-subsequence-ii',
];
