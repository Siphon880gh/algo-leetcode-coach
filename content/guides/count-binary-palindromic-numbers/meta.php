<?php
declare(strict_types=1);

return [
    'title' => 'Count Binary Palindromic Numbers: count by length, then by prefix',
    'leetcode' => 3677,
    'difficulty' => 'Hard',
    'summary' => 'Lengths 1 to L − 1 are full: 2 for length 1 (counting 0) and 2^(⌈l / 2⌉ − 1) for length l. For n’s own length L, count palindromes whose first half is below n’s first half, plus one if mirroring n’s first half stays ≤ n.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'math', 'leetcode'],
    'related_session' => 'count-binary-palindromic-numbers',
];
