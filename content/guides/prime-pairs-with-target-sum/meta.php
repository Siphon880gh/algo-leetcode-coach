<?php
declare(strict_types=1);

return [
    'title' => 'Prime Pairs With Target Sum: sieve, then x up to n / 2',
    'leetcode' => 2761,
    'difficulty' => 'Med',
    'summary' => 'Sieve primes up to n. For each x from 2 to n / 2, add [x, n − x] when both are prime; going only to n / 2 keeps x ≤ y and the list sorted.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'enumeration', 'number-theory', 'leetcode'],
    'related_session' => 'prime-pairs-with-target-sum',
];
