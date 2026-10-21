<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Palindrome Length From Subsequences: LPS on the concatenation',
    'leetcode' => 1771,
    'difficulty' => 'Hard',
    'summary' => 'Run longest-palindromic-subsequence DP on s = word1 + word2, but only record dp[i][j] as an answer when s[i] == s[j] with i in word1 and j in word2, so both subsequences are non-empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'string', 'leetcode'],
    'related_session' => 'maximize-palindrome-length-from-subsequences',
];
