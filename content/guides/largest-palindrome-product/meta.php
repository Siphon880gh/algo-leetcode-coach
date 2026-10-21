<?php
declare(strict_types=1);

return [
    'title' => 'Largest Palindrome Product: build palindromes from the top half, test for a factor',
    'leetcode' => 479,
    'difficulty' => 'Hard',
    'summary' => 'Largest palindrome that is the product of two n-digit numbers, mod 1337. Walk the left half a from 10^n − 1 down, mirror it into a 2n-digit palindrome, and look for a divisor t with t from 10^n − 1 down while t² ≥ the palindrome. First hit wins. n = 1 → 9. n = 2 → 987 (9009 mod 1337).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'enumeration', 'leetcode'],
    'related_session' => 'largest-palindrome-product',
];
