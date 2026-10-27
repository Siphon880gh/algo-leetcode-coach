<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product of the Length of Two Palindromic Substrings',
    'leetcode' => 1960,
    'difficulty' => 'Hard',
    'summary' => 'Manacher gives the longest odd palindrome at each center; build best[i] = longest odd palindrome ending at or before i (prefix max) and the same from the right, then maximize left[i] times right[i + 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-product-of-the-length-of-two-palindromic-substrings',
    'related_session' => 'maximum-product-of-the-length-of-two-palindromic-substrings',
];
