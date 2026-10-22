<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Non-overlapping Palindrome Substrings: lengths k and k + 1, carry dp forward',
    'leetcode' => 2472,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: test palindromes of length k and k + 1 ending at each position, and let dp[i] start from dp[i − 1]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-number-of-non-overlapping-palindrome-substrings',
    'tags' => ['two-pointers', 'string', 'dynamic-programming', 'greedy', 'step-by-step'],
];
