<?php
declare(strict_types=1);

return [
    'title' => 'Count Anagrams: multinomials per word, multiplied',
    'leetcode' => 2514,
    'difficulty' => 'Hard',
    'summary' => 'Words are permuted independently, so the answer is the product over words of the distinct arrangements of each one: len! divided by the factorial of each letter count. Precompute factorials and inverse factorials mod 10^9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['hash-table', 'math', 'string', 'combinatorics', 'counting', 'leetcode'],
    'related_session' => 'count-anagrams',
];
