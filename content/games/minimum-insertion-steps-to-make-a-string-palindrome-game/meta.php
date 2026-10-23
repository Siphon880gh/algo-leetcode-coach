<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Insertion Steps to Make a Palindrome: interval DP',
    'leetcode' => 1312,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = insertions for s[i..j]. Equal ends: dp[i+1][j−1]. Otherwise 1 + min(dp[i+1][j], dp[i][j−1]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-insertion-steps-to-make-a-string-palindrome',
    'related_session' => 'minimum-insertion-steps-to-make-a-string-palindrome',
];
