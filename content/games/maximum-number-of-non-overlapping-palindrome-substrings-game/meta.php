<?php
declare(strict_types=1);

return [
    'title' => 'Non-Overlapping Palindrome Substrings: only lengths k and k + 1 matter',
    'leetcode' => 2472,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = most palindromes in s[0..i). dp[i] = max(dp[i−1], dp[i−k] + 1 if s[i−k..i) is a palindrome, dp[i−k−1] + 1 if s[i−k−1..i) is).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-non-overlapping-palindrome-substrings',
    'related_session' => 'maximum-number-of-non-overlapping-palindrome-substrings',
];
