<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product of the Length of Two Palindromic Subsequences: masks',
    'leetcode' => 2002,
    'difficulty' => 'Med',
    'summary' => 'n ≤ 12, so enumerate all 2^n masks, keep those spelling a palindrome with their length, and maximise len(a) · len(b) over disjoint pairs (a & b == 0).',
    'category' => 'LeetCode',
    'subcategory' => 'Bitmask',
    'topic' => 'LeetCode · Bitmask',
    'kind' => 'algo',
    'tags' => ['bitmask', 'backtracking', 'string', 'leetcode'],
    'related_session' => 'maximum-product-of-the-length-of-two-palindromic-subsequences',
];
