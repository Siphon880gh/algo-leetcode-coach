<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Palindromic Rearrangement II: k-th arrangement of the half',
    'leetcode' => 3518,
    'difficulty' => 'Hard',
    'summary' => 'A palindrome is fixed by its first half, so count distinct arrangements of the half with the multinomial (letters left)! / Π(count)!, capped above k. Build the half left to right, skipping letters whose block is smaller than k.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['hash-table', 'math', 'string', 'combinatorics', 'counting', 'leetcode'],
    'related_session' => 'smallest-palindromic-rearrangement-ii',
];
