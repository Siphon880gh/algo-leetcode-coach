<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Missing Non-negative Integer After Operations: residues',
    'leetcode' => 2598,
    'difficulty' => 'Med',
    'summary' => 'Adding or subtracting value keeps each number’s remainder mod value, and any number can reach every target with its remainder. Count the remainders, then walk m = 0, 1, 2, … using one number of remainder m mod value each time.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'math', 'greedy', 'leetcode'],
    'related_session' => 'smallest-missing-non-negative-integer-after-operations',
];
