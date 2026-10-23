<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Palindrome Length From Subsequences: an outer pair must cross',
    'leetcode' => 1771,
    'difficulty' => 'Hard',
    'summary' => 'Run longest-palindromic-subsequence DP on word1 + word2. Only count dp[i][j] + 2 when s[i] == s[j] with i in word1 and j in word2, so both parts are non-empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-palindrome-length-from-subsequences',
    'related_session' => 'maximize-palindrome-length-from-subsequences',
];
