<?php
declare(strict_types=1);

return [
    'title' => 'Largest Palindrome Product: build palindromes from the top half, test for a factor',
    'leetcode' => 479,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: largest palindrome that is a product of two n-digit numbers, mod 1337. Build 2n-digit palindromes from the left half a, going down from 10^n − 1, and test divisors t from 10^n − 1 while t² ≥ p. n = 1 → 9. n = 2 → 987. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'enumeration', 'step-by-step'],
    'related_guide' => 'largest-palindrome-product',
];
