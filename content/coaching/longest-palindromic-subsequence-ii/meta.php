<?php
declare(strict_types=1);

return [
    'title' => 'Longest Palindromic Subsequence II: outer-letter DP',
    'leetcode' => 1682,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: f(i, j, prev) is the best good palindrome in s[i..j] whose outer letter differs from prev; matching ends unequal to prev add 2 and recurse with that letter. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'longest-palindromic-subsequence-ii',
    'tags' => ['dynamic-programming', 'string', 'step-by-step'],
];
